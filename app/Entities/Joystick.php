<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Joystick extends Entity
{
    protected $casts = [
        'id'      => 'integer',
        'couleur' => 'string',
        'modele'  => 'string',
    ];

    protected $datamap = [ 'id' => 'id_joystick' ];

	public function setModele(string $modele): static
	{
		$this->attributes['modele'] = $modele;
		return $this;
	}

	public function setCouleur(string $couleur): static
	{
		$this->attributes['couleur'] = $couleur;
		return $this;
	}
}
