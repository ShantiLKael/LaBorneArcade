<?php
namespace App\Entities;

use App\Models\OptionModel;
use CodeIgniter\Entity\Entity;

class Option extends Entity
{
    protected $casts = [
        'id'          => 'integer',
        'cout'        => 'integer',
        'nom'         => 'string',
        'description' => 'string',
        'idImage'     => 'integer'
    ];

    protected $datamap = [
        'id'      => 'id_option',
        'idImage' => 'id_image'
    ];

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

    public function setDescription(int $desc)
    {
        $this->attributes['description'] = $desc;
        
        return $this;
    }

    public function setIdImage(int $idImage)
    {
        $this->attributes['id_image'] = $idImage;
        
        return $this;
    }

    public function getImage(): Image
    {
        $optionModel = new OptionModel();
        return $optionModel->getImage($this->idImage);
    }
}
