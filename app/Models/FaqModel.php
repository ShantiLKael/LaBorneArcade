<?php
namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table = 'faq';
    protected $primaryKey = 'id_faq';
    protected $allowedFields = ['question', 'reponse', 'id_utilisateur'];
    protected $useTimestamps = false;

	// Règles de validation
	protected $validationRules = [
		'question' => 'required|min_length[5]|max_length[50]|regex_match[/^[^<>;{}]*$/]',
		'reponse'  => 'required|min_length[5]|max_length[500]|regex_match[/^[^<>;{}]*$/]',
	];

	protected $validationMessages = [
		'question' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'La question FAQ est trop longue (max. 50 caractères).',
			'min_length'  => 'La question FAQ est trop courte (min. 5 caractères).',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
        ],

		'reponse' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'La réponse FAQ est trop longue (max. 500 caractères).',
			'min_length'  => 'La réponse FAQ est trop courte (min. 5 caractères).',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
        ],
	];
}