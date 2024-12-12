<?php
namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model
{
    protected $table = 'image';
    protected $primaryKey = 'id_image';
    protected $allowedFields = ['chemin'];
	protected $returnType = 'App\Entities\Image';
}