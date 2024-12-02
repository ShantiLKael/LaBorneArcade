<?php
namespace App\Models;

use CodeIgniter\Model;

class JoystickModel extends Model
{
    protected $table = 'joystick';
    protected $primaryKey = 'id_joystick';
    protected $allowedFields = ['modele', 'couleur'];
    protected $useTimestamps = false;

	// Règles de validation
	protected $validationRules = [
		'modele'   => 'required|min_length[5]|max_length[50]|is_unique[bouton.modele,couleur]|regex_match[/^[^<>;{}]*$/]',
		'couleur'  => 'required|exact_length[7]',
	];

	protected $validationMessages = [
		'modele' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'Le nom de modèle est trop long (max. 50 caractères).',
			'min_length'  => 'Le nom de modèle est trop court (min. 5 caractères).',
			'is_unique'   => 'Ce joystick existe déjà.',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
        ],

		'couleur' => [
			'required'     => 'Champ requis.',
			'exact_length' => 'Entrer une couleur valide.',
        ],
	];
}