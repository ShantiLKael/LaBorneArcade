<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\BorneModel;
use CodeIgniter\I18n\Time;

class Borne extends Entity
{
    private BorneModel $borneModel;

    protected $casts = [
        'id'          => 'integer',
        'nom'         => 'string',
        'description' => 'string',
        'prix'        => 'integer',
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

	protected $dates = ['creation_borne'];

    public function setNom(string $nom)
    {
        $this->attributes['nom'] = $nom;
        return $this;
    }

    public function setCreationBorne(Time $time)
    {
        $this->attributes['date_creation'] = $time;
        return $this;
    }

    public function setDescription(string $description)
    {
        $this->attributes['description'] = $description;
        return $this;
    }

    public function setPrix(int $prix)
    {
        $this->attributes['prix'] = $prix;
        return $this;
    }

    public function setIdTMolding(?int $idTMolding)
    {
        $this->attributes['id_TMolding'] = $idTMolding;
        return $this;
    }

    public function setIdMatiere(?int $idMatiere)
    {
        $this->attributes['id_Matiere'] = $idMatiere;
        return $this;
    }

    public function setIdTheme(?int $idTheme)
    {
        $this->attributes['id_Theme'] = $idTheme;
        return $this;
    }

    public function getTheme(): Theme
    {
        $borneModel = new BorneModel();
        return $borneModel->getTheme($this->idTheme);
    }

    public function getMatier(): Matiere
    {
        $borneModel = new BorneModel();
        return $borneModel->getMatiere($this->idMatiere);
    }

    public function getTMolding(): TMolding
    {
        $borneModel = new BorneModel();
        return $borneModel->getTMolding($this->idTMolding);
    }

}