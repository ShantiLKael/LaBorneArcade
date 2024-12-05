<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\BornePersoModel;
use CodeIgniter\I18n\Time;

class BornePerso extends Entity
{

    protected $casts = [
        'id'          => 'integer',
        'prix'        => 'float',
        'idBorne'     => 'integer',
        'idTMolding'  => 'integer',
        'idMatiere'   => 'integer',
        'dateCreation'=> 'datetime',
        'dateModif'   => 'datetime',
    ];

    protected $datamap = [
        'id'          => 'id_borneperso',
        'idTMolding'  => 'id_tmolding',
        'idMatiere'   => 'id_matiere',
        'idBorne'     => 'id_borne',
        'dateCreation'=> 'date_creation',
        'dateModif'   => 'date_modif',
    ];

    public function setIdBorne(int $idBorne)
    {
        $this->attributes['id_borne'] = $idBorne;
        return $this;
    }

    public function setDateCreation(Time $time)
    {
        $this->attributes['date_creation'] = $time;
        return $this;
    }

    public function setDateModif(Time $time)
    {
        $this->attributes['date_modif'] = $time;
        return $this;
    }

    public function setPrix(float $prix)
    {
        $this->attributes['prix'] = $prix;
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

    public function getMatiere(): Matiere
    {
        $bornePersoModel = new BornePersoModel();
        return $bornePersoModel->getMatiere($this->idMatiere);
    }

    public function getTMolding(): TMolding
    {
        $bornePersoModel = new BornePersoModel();
        return $bornePersoModel->getTMolding($this->idTMolding);
    }

    public function getBorne(): Borne
    {
        $bornePersoModel = new BornePersoModel();
        return $bornePersoModel->getBorne($this->idBorne);
    }

    public function getOptions(): array
    {
        $bornePersoModel = new BornePersoModel();
        return $bornePersoModel->getOptions($this->id);
    }
}
