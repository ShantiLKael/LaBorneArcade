<?php
namespace App\Models;

use CodeIgniter\Model;

class ThemeModel extends Model
{
    protected $table = 'theme';
    protected $primaryKey = 'id_theme';
    protected $allowedFields = ['nom'];
    protected $useTimestamps = false;
	
	// Règles de validation
	protected $validationRules = [
		'nom'  => 'required|min_length[5]|max_length[50]|is_unique[theme.nom]|regex_match[/^[^<>;{}]*$/]',
	];

	protected $validationMessages = [
		'nom' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'Le nom du thème est trop long (max. 50 caractères).',
			'min_length'  => 'Le nom du thème est trop court (min. 5 caractères).',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
            'is_unique'   => 'Ce nom de thème existe déjà.'
		]
	];
}