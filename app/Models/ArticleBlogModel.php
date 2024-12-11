<?php
namespace App\Models;

use App\Entities\Image;
use App\Entities\Utilisateur;
use CodeIgniter\Model;
use Config\Database;

class ArticleBlogModel extends Model
{
	protected $table = 'articleblog';
	protected $primaryKey = 'id_articleblog';
	protected $allowedFields = ['titre', 'texte', 'id_utilisateur'];
	protected $returnType = 'App\Entities\ArticleBlog';
	
	// Règles de validation
	protected $validationRules = [
        'titre' => 'required|max_length[50]|min_length[5]|regex_match[/^[^<>;{}]*$/]',
        'texte' => 'required|max_length[800]|min_length[5]|regex_match[/^[^<>;{}]*$/]',
	];

	protected $validationMessages = [
		'titre' => [
            'required'    => 'Champ requis.',
			'max_length'  => 'Le titre est trop long (max. 50 caractères).',
			'min_length'  => 'Le titre est trop court (min. 5 caractères).',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
		],

		'texte' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'Le texte est trop long (max. 800 caractères).',
			'min_length'  => 'Le texte est trop court (min. 5 caractères).',
			'regex_match' => 'Les caractères < > ; { } sont interdits.',
		],
	];

    /* ---------------------------------------- */
	/* --------------- Fonction --------------- */
	/* ---------------------------------------- */

	/**
	 * Récupère un tableau d'Image de l'article.
	 * @param int $idArticleBlog
	 * @return array<Image>
	 */
	public function getImages(int $idArticleBlog): array
	{
		$builder = $this->db->table('image');
		$builder->select('image.*')
				->join('imagearticleblog', 'image.id_image = imagearticleblog.id_image')
				->where('imagearticleblog.id_articleblog', $idArticleBlog);
			
		$images = $builder->get()->getResult('App\Entities\Image');
		return $images ?: [];
	}

	/**
	 * Récupère l'utilisateur créateur de l'article.
	 * @param int $idUtilisateur
	 * @return Utilisateur
	 */
	public function getUtilisateur(int $idUtilisateur): Utilisateur
	{
		$builder = $this->db->table('utilisateur');
		$builder->select('utilisateur.*')
				->where('id_utilisateur', $idUtilisateur);
			
		$utilisateur = $builder->get()->getFirstRow('App\Entities\Utilisateur');
		return $utilisateur;
	}

	/**
	 * Insertion d'une Image de l'article.
	 *
	 * @param int $idArticleBlog
	 * @param int $idImage
	 * @return bool
	 */
	public function insererImageArticle(int $idArticleBlog, int $idImage): bool
	{
		$db = Database::connect();
		$builder = $db->table('imagearticleblog');

		$data = [
			'id_articleblog'=>$idArticleBlog,
			'id_image'      =>$idImage,
		];

		return $builder->insert($data);
	}
}
