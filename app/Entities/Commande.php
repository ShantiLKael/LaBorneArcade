<?php
namespace App\Entities;

use App\Models\CommandeModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class Commande extends Entity
{
    protected $casts = [
        'id'           => 'integer',
        'etat'         => 'string',
        'dateCreation' => 'datetime',
        'dateModif'    => 'datetime',
		'idBorne'      => 'integer',
		'idUtilisateur'=> 'integer',
    ];

    protected $datamap = [
		'id'             => 'id_commande',
		'idUtilisateur'  => 'id_utilisateur',
		'dateCreation'   => 'date_creation',
		'dateModif'      => 'date_modif',
		'idBorne'        => 'id_borneperso',
	];

	protected $dates = ['date_creation', 'date_modif'];

	public function setEtat(string $etat): static
	{
		$this->attributes['etat'] = $etat;
		return $this;
	}

	public function setDateCreation(Time $time): static
	{
		$this->attributes['date_creation'] = $time;
		return $this;
	}

	public function setDateModif(Time $time): static
	{
		$this->attributes['date_modif'] = $time;
		return $this;
	}

	public function getBorne(): BornePerso {
		$commandeModel = new CommandeModel();
		return $commandeModel->getBorne($this->idBorne);
	}
}
