<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int    id
 * @property string nom
 */
class Theme extends Entity
{
    protected $casts = [
        'id' =>'integer',
        'nom'=>'string',
    ];

	protected $datamap = [
		'id'=>'id_theme'
	];

	public function setNom(string $nom): static
	{
		$this->attributes['nom'] = $nom;
		return $this;
	}
}
