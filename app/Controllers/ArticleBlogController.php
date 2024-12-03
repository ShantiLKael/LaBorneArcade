<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Entities\ArticleBlog;
use App\Models\UtilisateurModel;
use App\Models\ArticleBlogModel;
use CodeIgniter\Model;

class ArticleBlogController extends BaseController
{
	public function __construct()
	{
		//Chargement du helper Form
		helper(['form']);
	}

	/**
	 * page par défaut
     * 
	 */
	public function index()
	{
		$articleModele = new ArticleBlogModel();
		$articles = $articleModele->findAll();
        return view('blog/index_article', ['articles' => $articles, 'titre' => 'blog']);
	}

	/**
	 * page détail d'un article
	 * @param int $idArticle
	 */
	public function voirArticle(int $idArticle)
	{
		$articleModele = new ArticleBlogModel();
		$articles = $articleModele->find($idArticle)->getArticle();
        return view('blog/voir_article'.$idArticle, ['articles' => $articles, 'titre' => 'blog']);
	}
}