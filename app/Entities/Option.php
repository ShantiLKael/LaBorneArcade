<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Option extends Entity
{
    protected $casts = [
        'id_option' => 'integer',
        'cout'      => 'integer',
        'nom'       => 'string',
    ];

    protected $datamap = [ 'id' => 'id_option' ];

    public function setCout(int $cout)
    {
        $this->attributes['cout'] = $cout;
        
        return $this;
    }

    public function setNom(int $nom)
    {
        $this->attributes['nom'] = $nom;
        
        return $this;
    }
}
