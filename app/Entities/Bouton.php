<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int    id
 * @property string modele
 * @property string forme
 * @property string couleur
 * @property bool   eclairage
 */
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
	
	public function setEclairage( bool $bool=false): Bouton
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
