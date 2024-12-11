<?php
namespace App\Models;

use CodeIgniter\Model;

class BoutonModel extends Model
{
    protected $table = 'bouton';
    protected $primaryKey = 'id_bouton';
    protected $allowedFields = ['modele', 'forme', 'couleur', 'eclairage'];
	protected $returnType = 'App\Entities\Bouton';

	// Règles de validation
	protected $validationRules = [
		'modele'    => 'required|min_length[5]|max_length[50]=|regex_match[/^[^<>;{}]*$/]',
		'forme'     => 'required|in_list[triangle,rond,carre]',
		'couleur'   => 'required|exact_length[7]',
	];

	protected $validationMessages = [
		'modele' => [
			'required'    => 'Le modele est requis.',
			'max_length'  => 'Le nom de modèle est trop long (max. 50 caractères).',
			'min_length'  => 'Le nom de modèle est trop court (min. 5 caractères).',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
        ],

		'forme' => [
			'required'    => 'La forme est requis.',
			'in_list'     => 'Entrer une forme valide.',
        ],

		'couleur' => [
			'required'     => 'La couleur est requis.',
			'exact_length' => 'Entrer une couleur valide.',
        ],
	];
}