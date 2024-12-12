<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int    id
 * @property string question
 * @property string reponse
 * @property int    idUtilisateur
 */
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

	public function setQuestion(string $question): static
	{
		$this->attributes['question'] = $question;
		return $this;
	}

	public function setReponse(string $reponse): static
	{
		$this->attributes['reponse'] = $reponse;
		return $this;
	}

	public function setIdUtilisateur(int $idUtilisateur): static
	{
		$this->attributes['id_Utilisateur'] = $idUtilisateur;
		return $this;
	}
}
