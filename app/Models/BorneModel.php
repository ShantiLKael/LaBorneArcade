<?php
namespace App\Models;

use App\Entities\Bouton;
use App\Entities\Image;
use App\Entities\Joystick;
use App\Entities\Option;
use CodeIgniter\Model;
use App\Entities\Theme;
use App\Entities\Matiere;
use App\Entities\TMolding;
use App\Entities\Borne;
use CodeIgniter\I18n\Time;
use Config\Database;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

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
    protected $useAutoIncrement = true;
	protected $primaryKey = 'id_borne';
	protected $returnType = 'App\Entities\Borne';
	protected $allowedFields = [
        'nom',
        'description',
        'prix',
        'id_tmolding',
        'id_matiere',
        'id_theme',
		'date_creation', // Table fille BornePerso
		'date_modif', // Table fille BornePerso
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
	
	public function getBornes(string $theme = null, string $type = null): array {
//		$model = $this;
//		if ($theme)
//			$model = $model->where('theme', $theme);
//		return ->findAll();
		return $this->findAll();
	}
	
	public function getBorneParId(int $id): Borne {
		return new Borne($this->find($id));
	}

	/**
	 * Récupère la Matière de la borne.
	 * @param int $idMatiere
	 * @return Matiere
	 */
	public function getMatiere(int $idMatiere): Matiere
	{
		$matiereModele = new MatiereModel();
		return new Matiere($matiereModele->find($idMatiere));
	}

	/**
	 * Récupère le TMolding de la borne.
	 * @param int $idTMolding
	 * @return TMolding
	 */
	public function getTMolding(int $idTMolding): TMolding
	{
		$tmoldingModele = new TMoldingModel();
		return new TMolding($tmoldingModele->find($idTMolding));
	}

	/**
	 * Récupère un tableau de Joystick de la borne.
	 * @param int $idBorne
	 * @return array<Joystick>
	 */
	public function getJoysticks(int $idBorne): array
	{
		$builder = $this->builder();
		$builder->select('joystick.*')->from('joystick')
				->join('joystick', 'joystick.id_joystick = joystickBorne.id_joystick')
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
		$builder->select('bouton.*')->from('bouton')
				->join('bouton', 'bouton.id_joystick = boutonborne.id_borne')
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
		$builder->select('option.*')->from('option')
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
}
