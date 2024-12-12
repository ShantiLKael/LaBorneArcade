<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Faq extends Entity
{
    protected $casts = [
        'id'       => 'integer',
        'question' => 'string',
        'reponse'  => 'string',
		'idUtilisateur' => 'integer',
    ];

    protected $datamap = [ 
		'id'            => 'id_faq',
		'idUtilisateur' => 'id_utilisateur',
	];

	public function setQuestion(string $question)
	{
		$this->attributes['question'] = $question;
		return $this;
	}

	public function setReponse(string $reponse)
	{
		$this->attributes['reponse'] = $reponse;
		return $this;
	}

	public function setIdUtilisateur(int $idUtilisateur)
	{
		$this->attributes['id_utilisateur'] = $idUtilisateur;
		return $this;
	}
}