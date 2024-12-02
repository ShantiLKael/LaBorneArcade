<?php
namespace App\Models;

use CodeIgniter\Model;

class MatiereModel extends Model
{
    protected $table = 'matiere';
    protected $primaryKey = 'id_matiere';
    protected $allowedFields = ['nom', 'couleur'];
    protected $useTimestamps = false;

	// Règles de validation
	protected $validationRules = [
		'nom'     => 'required|min_length[5]|max_length[50]|regex_match[/^[^<>;{}]*$/]|is_unique[bouton.nom,couleur]',
		'couleur' => 'required|exact_length[7]',
	];

	protected $validationMessages = [
		'nom' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'Le nom de la matière est trop longu (max. 50 caractères).',
			'min_length'  => 'Le nom de la matière est trop court (min. 5 caractères).',
			'is_unique'   => 'Cette matière existe déjà.',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
        ],

		'couleur' => [
			'required'     => 'Champ requis.',
			'exact_length' => 'Entrer une couleur valide.',
        ],
	];
}