<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Matiere extends Entity
{
    protected $casts = [
        'id'      => 'integer',
        'couleur' => 'string',
        'nom'     => 'string',
    ];

    protected $datamap = [ 'id' => 'id_matiere' ];

	public function setNom(string $nom)
	{
		$this->attributes['nom'] = $nom;
		return $this;
	}

	public function setCouleur(string $couleur)
	{
		$this->attributes['couleur'] = $couleur;
		return $this;
	}
}