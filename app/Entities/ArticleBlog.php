<?php
namespace App\Entities;

use App\Models\ArticleBlogModel;
use CodeIgniter\Entity\Entity;

/**
 * Cette entité représente un article du blog du site <i>LaBorneArcade</i>.
 */
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
	
	/**
	 * Définit le titre de l'article de blog.
	 *
	 * @param string $titre Le nouveau titre.
	 * @return $this L'instance d'ArticleBlog.
	 */
	public function setTitre(string $titre): static {
		$this->attributes['titre'] = $titre;
		return $this;
	}
	
	/**
	 * Définit le contenu de l'article de blog.
	 *
	 * @param string $texte Le nouveau contenu.
	 * @return $this L'instance d'ArticleBlog.
	 */
	public function setTexte(string $texte): static {
		$this->attributes['texte'] = $texte;
		return $this;
	}
	
	/**
	 * Définit l'identifiant de l'utilisateur de l'article.
	 *
	 * @param int $idUtilisateur L'identifiant de l'utilisateur.
	 * @return $this L'instance d'ArticleBlog.
	 */
	public function setIdUtilisateur(int $idUtilisateur): static {
		$this->attributes['id_utilisateur'] = $idUtilisateur;
		return $this;
	}
	
	/**
	 * Retourne les images de l'article.
	 *
	 * @return Image[] La liste des images.
	 */
	public function getImages(): array {
		$articleModel = new ArticleBlogModel();
		return $articleModel->getImages($this->id);
	}
	
	/**
	 * Retourne l'utilisateur de cet article.
	 *
	 * @return Utilisateur L'utilisateur ayant édité cet article.
	 */
	public function getUtilisateur(): Utilisateur {
		$articleModel = new ArticleBlogModel();
		return $articleModel->getUtilisateur($this->idUtilisateur);
	}
}
