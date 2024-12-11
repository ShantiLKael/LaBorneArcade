<?php
namespace App\Entities;

use App\Models\ArticleBlogModel;
use CodeIgniter\Entity\Entity;

class ArticleBlog extends Entity
{
    protected $casts = [
        'id'            => 'integer',
        'idUtilisateur' => 'integer',
        'titre'         => 'string',
        'texte'         => 'string',
    ];

    protected $datamap = [
        'id'            => 'id_articleblog',
        'idUtilisateur' => 'id_utilisateur',
    ];

    /* ---------------------------------------- */
	/* ---------------- Setter ---------------- */
	/* ---------------------------------------- */

	public function setTitre(string $titre): static {
		$this->attributes['titre'] = $titre;
		return $this;
	}

	public function setTexte(string $texte): static {
		$this->attributes['texte'] = $texte;
		return $this;
	}

	public function setIdUtilisateur(int $idUtilisateur): static {
		$this->attributes['id_Utilisateur'] = $idUtilisateur;
		return $this;
	}

	public function getImages(): array {
		$articleModel = new ArticleBlogModel();
		return $articleModel->getImages($this->id);
	}

	public function getUtilisateur(): Utilisateur {
		$articleModel = new ArticleBlogModel();
		return $articleModel->getUtilisateur($this->idUtilisateur);
	}
}
