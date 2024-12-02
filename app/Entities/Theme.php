<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Theme extends Entity
{
    protected $casts = [
        'id'  => 'integer',
        'nom' => 'string',
    ];

	protected $datamap = [ 'id' => 'id_theme' ];

	public function setNom(string $nom)
	{
		$this->attributes['nom'] = $nom;
		return $this;
	}
}