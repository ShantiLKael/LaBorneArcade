<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\BorneModel;
use CodeIgniter\I18n\Time;

class Borne extends Entity
{
	/** @var BorneModel $borneModel */
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

	public function __construct(?array $data = null) {
		parent::__construct($data);
		$this->borneModel = new BorneModel();
	}
	
    public function setNom(string $nom)
    {
        $this->attributes['nom'] = $nom;
        return $this;
    }

    public function setDescription(string $description)
    {
        $this->attributes['description'] = $description;
        return $this;
    }

    public function setPrix(float $prix)
    {
        $this->attributes['prix'] = $prix;
        return $this;
    }

    public function setOrdre(int $ordre)
    {
        $this->attributes['ordre'] = $ordre;
        return $this;
    }

    public function setIdTMolding(int $idTMolding)
    {
        $this->attributes['id_tmolding'] = $idTMolding;
        return $this;
    }

    public function setIdMatiere(int $idMatiere)
    {
        $this->attributes['id_matiere'] = $idMatiere;
        return $this;
    }

    public function setIdTheme(int $idTheme)
    {
        $this->attributes['id_theme'] = $idTheme;
        return $this;
    }

    public function getPrix(): float
    {
        return $this->attributes['prix'];
    }

    public function getOrdre(): int
    {
        return $this->attributes['ordre'];
    }

    public function getTheme(): Theme
    {
        return $this->borneModel->getTheme($this->idTheme);
    }

    public function getMatiere(): Matiere
    {
        $borneModel = new BorneModel();
        return $borneModel->getMatiere($this->idMatiere);
    }

    public function getTMolding(): TMolding
    {
        $borneModel = new BorneModel();
        return $borneModel->getTMolding($this->idTMolding);
    }

    public function getOptions(): array
    {
        $borneModel = new BorneModel();
        return $borneModel->getOptions($this->id);
    }

    public function getBoutons(): array
    {
        $borneModel = new BorneModel();
        return $borneModel->getBoutons($this->id);
    }

    public function getJoysticks(): array
    {
        $borneModel = new BorneModel();
        return $borneModel->getJoysticks($this->id);
    }

    public function getImages(): array
    {
        $borneModel = new BorneModel();
        return $borneModel->getImages($this->id);
    }

}
