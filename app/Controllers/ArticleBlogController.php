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
	 * @return \CodeIgniter\HTTP\RedirectResponse blog-articles version potentiel acheteur
	 */
	public function index()
	{
		$articleModele = new ArticleBlogModel();
		$articles = $articleModele->findAllArticle();
		return redirect()->to('blog-articles')->with('articles',$articles);
	}

	/**
	 * page détail d'un article
	 * @param int $idArticle
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function voirArticle(int $idArticle)
	{
		$articleModele = new ArticleBlogModel();
		$articles = $articleModele->find($idArticle)->getArticle();
		return redirect()->to('blog-articles/'.$idArticle)->with('articles',$articles);
	}
}