<?php
namespace App\Models;

use CodeIgniter\Model;

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
		'id_image'   => 'required',
	];

	protected $validationMessages = [
		'nom' => [
			'required'    => 'Champ requis.',
			'is_unique'   => 'Le nom de l\'option existe déjà.',
			'max_length'  => 'Le nom de l\'option est trop long (max. 50 caractères).',
			'min_length'  => 'Le nom de l\'option est trop court (min. 5 caractères).',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
        ],

		'description' => [
			'required'     => 'Champ requis.',
			'max_length'   => 'La description est trop longue (max. 500 caractères).',
			'regex_match'  => 'Les caractères < > ; { } sont interdits.',
        ],

		'cout' => [
			'required'              => 'Champ requis.',
			'greater_than_equal_to' => 'Entrer un cout supérieur à zéro.',
        ],

		'id_image' => [ 'required' => 'Champ requis.' ],
	];
}