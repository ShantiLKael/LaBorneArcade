<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Doctrine\DBAL\Types\BooleanType;

class Bouton extends Entity
{
    protected $casts = [
        'id'        => 'integer',
        'modele'    => 'string',
        'forme'     => 'string',
        'couleur'   => 'string',
		'eclairage' => 'boolean',
    ];

    protected $datamap = [  'id' => 'id_bouton' ];

	public function setModele(string $modele): Bouton
	{
		$this->attributes['modele'] = $modele;

		return $this;
	}
	
	public function setForme(string $forme): Bouton
	{
		$this->attributes['forme'] = $forme;

		return $this;
	}
	
	public function setCouleur(string $couleur): Bouton
	{
		$this->attributes['couleur'] = $couleur;

		return $this;
	}
	
	public function setEclairage( string $bool='false'): Bouton
	{
		$this->attributes['eclairage'] = $bool;

		return $this;
	}
	
	public function setIdImage(int $id): Bouton
	{
		$this->attributes['id_Image'] = $id;

		return $this;
	}
}