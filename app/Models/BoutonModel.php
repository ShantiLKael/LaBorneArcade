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
		'modele'    => 'required|min_length[5]|max_length[50]|is_unique[bouton.modele,couleur,forme,eclairage]|regex_match[/^[^<>;{}]*$/]',
		'forme'     => 'required|in_list[triangle,rond,carre]',
		'eclairage' => 'required|', // TODO boolean
		'couleur'   => 'required|exact_length[7]',
	];

	protected $validationMessages = [
		'libelle' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'Le nom de modèle est trop long (max. 50 caractères).',
			'min_length'  => 'Le nom de modèle est trop court (min. 5 caractères).',
			'is_unique'   => 'Ce bouton existe déjà.',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
        ],

		'forme' => [
			'required'    => 'Champ requis.',
			'in_list'     => 'Entrer une forme valide.',
        ],

		'couleur' => [
			'required'     => 'Champ requis.',
			'exact_length' => 'Entrer une couleur valide.',
        ],

		'eclairage' => [ 'required' => 'Champ requis.', ],
	];
}