<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ArticleBlog extends Entity
{
    protected $casts = [
        'id'          => 'integer',
        'utilisateur' => 'App\Entities\Utilisateur',
        'titre'       => 'string',
        'texte'       => 'string',
    ];

    protected $datamap = [
        'id'          => 'id_articleblog',
        'utilisateur' => 'id_utilisateur',
    ];

    /* ---------------------------------------- */
	/* ---------------- Setter ---------------- */
	/* ---------------------------------------- */

	public function setTitre(string $titre) {
		$this->attributes['titre'] = $titre;
		return $this;
	}

	public function setTexte(string $texte){
		$this->attributes['texte'] = $texte;
		return $this;
	}

	public function setIdUtilisateur(int $idUtilisateur){
		$this->attributes['id_Utilisateur'] = $idUtilisateur;
		return $this;
	}
}