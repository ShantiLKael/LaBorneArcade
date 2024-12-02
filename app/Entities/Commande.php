<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class Commande extends Entity
{
    protected $casts = [
        'id'           => 'integer',
        'etat'         => 'string',
        'dateCreation' => 'datetime',
        'dateModif'    => 'datetime',
		'borne'        => 'App\Entities\Borne',
		'utilisateur'  => 'App\Entities\Utilisateur',
    ];

    protected $datamap = [ 
		'id'           => 'id_commande',
		'utilisateur'  => 'id_utilisateur',
		'dateCreation' => 'date_creation',
		'dateModif'    => 'date_modif',
		'borne'      => 'id_borne',
	];

	protected $dates = ['date_creation', 'date_modif'];

	public function setEtat(string $etat): Commande
	{
		$this->attributes['etat'] = $etat;
		return $this;
	}

	public function setDateCreation(Time $time): Commande
	{
		$this->attributes['date_creation'] = $time;
		return $this;
	}

	public function setDateModif(Time $time)
	{
		$this->attributes['date_modif'] = $time;
		return $this;
	}
}