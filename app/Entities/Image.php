<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Image extends Entity
{
    protected $casts = [
        'id'     => 'integer',
        'chemin' => 'string',
    ];

    protected $datamap = [ 'id' => 'id_image' ];

	public function setChemin(string $chemin): static
	{
		$this->attributes['chemin'] = $chemin;
		return $this;
	}
}
