<?php
namespace App\Models;

use App\Entities\Bouton;
use App\Entities\Image;
use App\Entities\Joystick;
use App\Entities\Option;
use App\Entities\Theme;
use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use App\Entities\Matiere;
use App\Entities\TMolding;
use App\Entities\Borne;
use CodeIgniter\I18n\Time;
use Config\Database;
use Exception;

class BorneModel extends Model
{
	/**
	 * @property int $MAX_JOYSTICK Le nombre maximum de boutons sur la borne.
	 * Utilisé pour la clause SQL LIMIT
	 */
	private static int $MAX_BOUTON = 12;
	
	/**
	 * @property int $MAX_JOYSTICK Le nombre maximum de joysticks sur la borne.
	 * Utilisé pour la clause SQL LIMIT
	 */
	private static int $MAX_JOYSTICK = 2;


	protected $table      = 'borne';
	protected $primaryKey = 'id_borne';
	protected $returnType = 'App\Entities\Borne';
	protected $allowedFields = [
        'nom',
        'description',
        'prix',
        'id_tmolding',
        'id_matiere',
		'id_image',
        'id_theme',
		'date_creation', // Table fille BornePerso
    ];
	
	// Règles de validation
	protected $validationRules = [
        'nom'         => 'required|max_length[50]|min_length[5]|regex_match[/^[^<>;{}]*$/]',
        'description' => 'required|max_length[500]|regex_match[/^[^<>;{}]*$/]',
        'prix'        => 'required|greater_than[0]',
		'id_tmolding' => 'required',
		'id_matiere'  => 'required',
		'id_theme'    => 'required',
	];

	protected $validationMessages = [
		'nom' => [
            'required'    => 'Champ requis.',
			'max_length'  => 'Le nom de la borne est trop long (max. 50 caractères).',
			'min_length'  => 'Le nom de la borne est trop court (min. 5 caractères).',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
		],

		'description' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'La description est trop longue (max. 500 caractères).',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
		],

		'prix' => [
			'required'     => 'Champ requis.',
			'greater_than' => 'Le prix doit être supérieur à zéro.',
		],

		'id_tmolding' => [ 'required' => 'Champ requis.'],
		'id_matiere'  => [ 'required' => 'Champ requis.'],
		'id_theme'    => [ 'required' => 'Champ requis.'],
	];
	
	public function getBornes(array $themes = [], array $types = []): array {
		$builder = $this->builder()->select("b.*, string_agg(i.chemin, ',') AS image");
		$builder = $builder->from('ONLY Borne b', true);
		$builder = $builder->join('Image i', 'b.id_image = i.id_image');
		if (count($themes) > 0)
			$builder = $builder->whereIn('id_theme', $themes);
		$query = $builder->getCompiledSelect();
		if (count($themes) === 0 && count($types) !== 0)
			$query .= " WHERE";
		$types = array_map(fn($type) => match($type) {
			"sticker"=>1,
			"wood"=>2,
			"gravure"=>3,
			default=>-1,
		}, $types);
		$typeStr = array_map(fn($t) => " $t IN (SELECT id_option FROM OptionBorne ob WHERE ob.id_borne = b.id_borne)", $types);
		$typeStr = implode(" OR", $typeStr);
		if (count($themes) > 0)
			$query .= " OR" . $typeStr;
		else {
			$query .= $typeStr;
		}
		$query .= " GROUP BY b.id_image, id_borne, nom, description, prix, id_tmolding, id_matiere, id_theme";
		return $this->db->prepare(fn($db) => (new Query($db))->setQuery($query))->execute()->getCustomResultObject($this->returnType);
	}
	
	public function getBorneParId(int $id): Borne|array {
		return $this->find($id);
	}
	
	/**
	 * @deprecated À supprimer si aucune utilitée dans l'avenir proche.
	 * @return array
	 */
	private function getBornePersoIds(): array {
		$builder = $this->builder("BornePerso")->select('id_borne');
		$results = $builder->get()->getResult();
		return array_map(function ($r) {
			return $r->id_borne;
		}, $results);
	}

	/**
	 * Récupère la Matière de la borne.
	 * @param int $idMatiere
	 * @return Matiere|array
	 */
	public function getMatiere(int $idMatiere): Matiere|array
	{
		$matiereModele = new MatiereModel();
		return $matiereModele->find($idMatiere);
	}

	/**
	 * Récupère le Thème de la borne.
	 * @param int $idTheme
	 * @return Theme|array
	 */
	public function getTheme(int $idTheme): Theme|array
	{
		$themeModel = new ThemeModel();
		return $themeModel->find($idTheme);
	}

	/**
	 * Récupère le TMolding de la borne.
	 * @param int $idTMolding
	 * @return TMolding|array
	 */
	public function getTMolding(int $idTMolding): TMolding|array
	{
		$tmoldingModele = new TMoldingModel();
		return $tmoldingModele->find($idTMolding);
	}

	/**
	 * Récupère un tableau de Joystick de la borne.
	 * @param int $idBorne
	 * @return array<Joystick>
	 */
	public function getJoysticks(int $idBorne): array
	{
		$builder = $this->builder();
		$builder->select('joystick.*')->from('joystickborne')
				->join('joystick', 'joystick.id_joystick = joystickborne.id_joystick')
				->where('joystickborne.id_borne', $idBorne);
			
		return $builder->get(BorneModel::$MAX_JOYSTICK)->getResult('App\Entities\Joystick');
	}

	/**
	 * Insertion d'un Joystick de la borne
	 * @param int $idBorne
	 * @param int $idJoystick
	 * @return bool
	 */
	public function insererJoystickBorne(int $idBorne, int $idJoystick): bool
	{
		$db = Database::connect();
		$builder = $db->table('joystickborne');

		$data = [
			'id_borne'    => $idBorne,
			'id_joystick' => $idJoystick,
		];

		return $builder->insert($data);
	}

	/**
	 * Récupère un tableau de Bouton de la borne.
	 * @param int $idBorne
	 * @return array<Bouton>
	 */
	public function getBoutons(int $idBorne): array
	{
		$builder = $this->builder();
		$builder->select('bouton.*')->from('boutonborne')
				->join('bouton', 'bouton.id_bouton = boutonborne.id_bouton')
				->where('boutonborne.id_borne', $idBorne);
			
		return $builder->get(BorneModel::$MAX_BOUTON)->getResult('App\Entities\Bouton');
	}

	/**
	 * Insertion d'un Bouton de la borne.
	 * @param int $idBorne
	 * @param int $idBouton
	 * @return bool
	 */
	public function insererBoutonBorne(int $idBorne, int $idBouton): bool
	{
		$db = Database::connect();
		$builder = $db->table('boutonborne');

		$data = [
			'id_borne'  => $idBorne,
			'id_bouton' => $idBouton,
		];
		
		return $builder->insert($data);
	}

	/**
	 * Récupère un tableau d'Image de la borne.
	 * @param int $idBorne
	 * @return array<Image>
	 */
	public function getImages(int $idBorne): array
	{
		$builder = $this->builder();
		$builder->select('image.*')->from('image')
				->join('image', 'image.id_image = imageborne.id_image')
				->where('imageborne.id_borne', $idBorne);
			
		$images = $builder->get()->getResult('App\Entities\Image');
		return $images ?: [];
	}

	/**
	 * Insertion d'une Image de la borne
	 * @param int $idBorne
	 * @param int $idImage
	 * @return bool
	 */
	public function insererImageBorne(int $idBorne, int $idImage): bool
	{
		$db = Database::connect();
		$builder = $db->table('imageborne');

		$data = [
			'id_borne' => $idBorne,
			'id_image' => $idImage,
		];
		
		return $builder->insert($data);
	}

	/**
	 * Récupère un tableau d'Option de la borne.
	 * @param int $idBorne
	 * @return array<Option>
	 */
	public function getOptions(int $idBorne): array
	{
		$builder = $this->builder();
		$builder->select('option.*')->distinct()->from('optionborne')
				->join('option', 'option.id_option = optionborne.id_option')
				->where('optionborne.id_borne', $idBorne);
			
		$options = $builder->get()->getResult('App\Entities\Option');
		return $options ?: [];
	}

	/**
	 * Insertion d'une Option de la borne.
	 * @param int $idBorne
	 * @param int $idOption
	 * @return bool
	 */
	public function insererOptionBorne(int $idBorne, int $idOption): bool
	{
		$db = Database::connect();
		$builder = $db->table('optionborne');

		$data = [
			'id_borne'  => $idBorne,
			'id_option' => $idOption,
		];
		
		return $builder->insert($data);
	}

	/**
	 * Suppression d'une BornePerso un mois après sa dernière modification.
	 * @return bool
	 */
	public function suppPeriodiqueBornePerso(): bool
    {
        $db = Database::connect();
        $builder = $db->table('borneperso');

        $moisDernier = date('d-m-Y H:i:s', strtotime('-1 month'));

        $builder->where('date_modif <', $moisDernier);
        return $builder->delete();
    }
	
	/**
	 * Insertion d'une BornePerso.
	 *
	 * @param Borne $borne
	 * @return bool
	 * @throws Exception
	 */
	public function insererBornePerso(Borne $borne): bool
	{
		$builder = db_connect()->table('borneperso');
		$bornePerso = $borne->toArray();
		$bornePerso['date_creation'] = Time::now('Europe/Paris', 'fr_FR');
		$bornePerso['date_modiff']   = Time::now('Europe/Paris', 'fr_FR');
		return $builder->insert($bornePerso);
	}

	/**
	 * Suppression d'une borne et de ses composants
	 * (Panier, Option, Joystick, Bouton, Image et Commande)
	 *
	 * @param int $idBorne identifiant de la borne
	 * @return void
	 */
	public function deleteCascade(int $idBorne): void
	{
		$db = Database::connect();

		// Chargement des modèles
		$panierModel        = $db->table('panier');
		$optionBorneModel   = $db->table('optionborne');
		$joystickBorneModel = $db->table('joystickborne');
		$boutonBorneModel   = $db->table('boutonborne');
		$imageBorneModel    = $db->table('imageborne');

		$commandeModel = new CommandeModel();
		$joystickModel = new JoystickModel();
		$boutonModel   = new BoutonModel();
		$borneModel    = new BorneModel();

		// Suppression de la borne des images
		$imageBorneModel->where('id_borne', $idBorne)->delete();

		// Suppression de la borne de la commande
		$commandeModel->where('id_borne', $idBorne)->delete();

		// Suppression de la borne du panier
		$panierModel->where('id_borne', $idBorne)->delete();

		// Suppression des options associées
		$optionBorneModel->where('id_borne', $idBorne)->delete();

		// Suppression des relations Joysticks-Borne et gestion des joysticks orphelins
		$joysticks = $this->getJoysticks($idBorne);
		foreach ($joysticks as $joystick) {
			$idJoystick = $joystick->id;
			$joystickBorneModel->where('id_borne', $idBorne)
								->where('id_joystick', $idJoystick)
								->delete();

			// Vérifier si le joystick est utilisé ailleurs
			if ($joystickBorneModel->where('id_joystick', $idJoystick)->countAllResults() == 0) {
				$joystickModel->delete($idJoystick);
			}
		}

		// Suppression des relations Boutons-Borne et gestion des boutons orphelins
		$boutons = $this->getBoutons($idBorne);
		foreach ($boutons as $bouton) {
			$idBouton = $bouton->id;
			$boutonBorneModel->where('id_borne', $idBorne)
								->where('id_bouton', $idBouton)
								->delete();

			// Vérifier si le bouton est utilisé ailleurs
			if ($boutonBorneModel->where('id_bouton', $idBouton)->countAllResults() == 0) {
				$boutonModel->delete($idBouton);
			}
		}

		$borneModel->delete($idBorne);
	}
	
}
