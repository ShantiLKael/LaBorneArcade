<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\BorneModel;

/**
 * Cette entité représente une borne prédéfinie sur le site <i>LaBorneArcade</i>.
 *
 * @property int    id
 * @property string nom
 * @property string description
 * @property float  prix
 * @property int    ordre
 * @property int    idTMolding
 * @property int    idMatiere
 * @property int    idTheme
 * @property string image
 */
class Borne extends Entity
{
	
    private BorneModel $borneModel;

    protected $casts = [
        'id'          => 'integer',
        'nom'         => 'string',
        'description' => 'string',
        'prix'        => 'float',
        'ordre'       => 'integer',
        'idTMolding'  => 'integer',
        'idMatiere'   => 'integer',
        'idTheme'     => 'integer',
    ];

    protected $datamap = [
        'id'          => 'id_borne',
        'idTMolding'  => 'id_tmolding',
        'idMatiere'   => 'id_matiere',
        'idTheme'     => 'id_theme',
    ];
	
	/**
	 * Constructeur de l'entité Borne.
	 *
	 * @param array|null $data Les données à ajouter dans l'entité ou <i>null</i>.
	 */
	public function __construct(?array $data = null) {
		parent::__construct($data);
		$this->borneModel = new BorneModel();
	}
	
	/**
	 * Définit le nom de la borne.
	 *
	 * @param string $nom Le nouveau nom.
	 * @return $this L'instance de Borne.
	 */
    public function setNom(string $nom): static
	{
        $this->attributes['nom'] = $nom;
        return $this;
    }
	
	/**
	 * Définit la description de la borne.
	 *
	 * @param string $description La nouvelle description.
	 * @return $this L'instance de Borne.
	 */
    public function setDescription(string $description): static
    {
        $this->attributes['description'] = $description;
        return $this;
    }
	
	/**
	 * Définit le prix de la borne.
	 *
	 * @param float $prix Le nouveau prix.
	 * @return $this L'instance de Borne.
	 */
    public function setPrix(float $prix): static
    {
        $this->attributes['prix'] = $prix;
        return $this;
    }
	
	/**
	 * TODO: Chercher ce à quoi ça signifie.
	 */
    public function setOrdre(int $ordre): static
    {
        $this->attributes['ordre'] = $ordre;
        return $this;
    }
	
	/**
	 * Définit le T-Molding de la borne.
	 *
	 * @param int $idTMolding L'identifiant du T-Molding.
	 * @return $this L'instance de Borne.
	 */
    public function setIdTMolding(int $idTMolding): static
    {
        $this->attributes['id_tmolding'] = $idTMolding;
        return $this;
    }
	
	/**
	 * Définit la matière de la borne.
	 *
	 * @param int $idMatiere L'identifiant de la matière.
	 * @return $this L'instance de Borne.
	 */
    public function setIdMatiere(int $idMatiere): static
    {
        $this->attributes['id_matiere'] = $idMatiere;
        return $this;
    }
	
	/**
	 * Définit le thème de la borne.
	 *
	 * @param int $idTheme L'identifiant du thème.
	 * @return $this L'instance de Borne.
	 */
    public function setIdTheme(int $idTheme): static
    {
        $this->attributes['id_theme'] = $idTheme;
        return $this;
    }
	
	/**
	 * Retourne le prix.
	 *
	 * @return float Le prix de la borne.
	 */
    public function getPrix(): float
    {
        return $this->attributes['prix'];
    }
	
	/**
	 * TODO: Chercher ce à quoi ça signifie.
	 */
    public function getOrdre(): int
    {
        return $this->attributes['ordre'];
    }
	
	/**
	 * Retourne le thème.
	 *
	 * @return Theme Le thème de la borne.
	 */
    public function getTheme(): Theme
    {
        return $this->borneModel->getTheme($this->idTheme);
    }
	
	/**
	 * Retourne la matière.
	 *
	 * @return Matiere La matière de la borne.
	 */
    public function getMatiere(): Matiere
    {
        $borneModel = new BorneModel();
        return $borneModel->getMatiere($this->idMatiere);
    }
	
	/**
	 * Retourne le T-Molding.
	 *
	 * @return TMolding Le T-Molding de la borne.
	 */
    public function getTMolding(): TMolding
    {
        $borneModel = new BorneModel();
        return $borneModel->getTMolding($this->idTMolding);
    }
	
	/**
	 * Retourne les options.
	 *
	 * @return Option[] Les options de la borne.
	 */
    public function getOptions(): array
    {
        $borneModel = new BorneModel();
        return $borneModel->getOptions($this->id);
    }
	
	/**
	 * Retourne les boutons.
	 *
	 * @return Bouton[] Les boutons de la borne.
	 */
    public function getBoutons(): array
    {
        $borneModel = new BorneModel();
        return $borneModel->getBoutons($this->id);
    }
	
	/**
	 * Retourne les joysticks.
	 *
	 * @return Joystick[] Les joysticks de la borne.
	 */
    public function getJoysticks(): array
    {
        $borneModel = new BorneModel();
        return $borneModel->getJoysticks($this->id);
    }
	
	/**
	 * Retourne les images.
	 *
	 * @return Image[] Les images de la borne.
	 */
    public function getImages(): array
    {
        $borneModel = new BorneModel();
        return $borneModel->getImages($this->id);
    }

}
