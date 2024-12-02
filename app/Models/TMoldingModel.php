<?php
namespace App\Models;

use CodeIgniter\Model;

class TMoldingModel extends Model
{
    protected $table = 'tmolding';
    protected $primaryKey = 'id_tmolding';
    protected $allowedFields = ['nom', 'couleur'];
    protected $useTimestamps = false;

	// Règles de validation
	protected $validationRules = [
		'nom'   => 'required|min_length[5]|max_length[50]|regex_match[/^[^<>;{}]*$/]|is_unique[bouton.nom,couleur]',
		'couleur'  => 'required|exact_length[7]',
	];

	protected $validationMessages = [
		'libelle' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'Le nom du t-molding est trop long (max. 50 caractères).',
			'min_length'  => 'Le nom du t-molding est trop court (min. 5 caractères).',
			'is_unique'   => 'Ce t-molding existe déjà.',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
        ],

		'couleur' => [
			'required'     => 'Champ requis.',
			'exact_length' => 'Entrer une couleur valide.',
        ],
	];
}