<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class TMolding extends Entity
{
    protected $casts = [
        'id'      => 'integer',
        'nom'     => 'string',
        'couleur' => 'string',
    ];

	protected $datamap = [ 'id' => 'id_tmolding' ];

	public function setNom(string $nom): static
	{
		$this->attributes['nom'] = $nom;
		return $this;
	}

	public function setCouleur(string $couleur): static
	{
		$this->attributes['couleur'] = $couleur;
		return $this;
	}
	
}
