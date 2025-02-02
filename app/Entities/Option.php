<?php
namespace App\Entities;

use App\Models\OptionModel;
use CodeIgniter\Entity\Entity;

/**
 * @property int    id
 * @property int    cout
 * @property string nom
 * @property string description
 * @property int    idImage
 */
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

    public function setCout(string $cout): static
    {
        $this->attributes['cout'] = $cout;
        return $this;
    }

    public function setNom(string $nom): static
    {
        $this->attributes['nom'] = $nom;
        return $this;
    }

    public function setDescription(string $desc): static
    {
        $this->attributes['description'] = $desc;
        return $this;
    }

    public function setIdImage(int $idImage): static
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
