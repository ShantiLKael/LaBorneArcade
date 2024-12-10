<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Image;

class OptionModel extends Model
{
    protected $table = 'option';
    protected $primaryKey = 'id_option';
    protected $allowedFields = ['nom', 'description', 'cout', 'id_image'];
	protected $returnType = 'App\Entities\Option';
	

	// Règles de validation
	protected $validationRules = [
		'nom'        => 'required|min_length[5]|max_length[50]|is_unique[option.nom]|regex_match[/^[^<>;{}]*$/]',
		'description'=> 'required|max_length[500]|regex_match[/^[^<>;{}]*$/]',
		'cout'       => 'required|greater_than_equal_to[0]',
	];

	protected $validationMessages = [
		'nom' => [
			'required'    => 'nom requis.',
			'is_unique'   => 'Le nom de l\'option existe déjà.',
			'max_length'  => 'Le nom de l\'option est trop long (max. 50 caractères).',
			'min_length'  => 'Le nom de l\'option est trop court (min. 5 caractères).',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
        ],

		'description' => [
			'required'     => 'description requis.',
			'max_length'   => 'La description est trop longue (max. 500 caractères).',
			'regex_match'  => 'Les caractères < > ; { } sont interdits.',
        ],

		'cout' => [
			'required'              => 'cout requis.',
			'greater_than_equal_to' => 'Entrer un cout supérieur à zéro.',
        ],
	];

	
	/**
	 * Récupère l'Image de l'option.
	 * @param int $idImage
	 * @return Image
	 */
	public function getImage(int $idImage): Image
	{
		$imageModel = new ImageModel();
		return $imageModel->find($idImage);
	}

    public function getOptionsWithImages()
	{
		return $this->db->table('option')
			->select('option.*, image.chemin as image_chemin') // Sélectionner les colonnes nécessaires
			->join('image', 'image.id_image = option.id_image', 'left') // Jointure avec la table images
			->get()
			->getResult();
	}
}