<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Entities\ArticleBlog;
use App\Models\UtilisateurModel;
use App\Models\ArticleBlogModel;
use CodeIgniter\Model;

class ArticleBlogController extends BaseController
{
    /** @var ArticleBlogModel $articleBlogModele */
	private ArticleBlogModel $articleBlogModele;
	public function __construct()
	{
        $this->articleBlogModele = new ArticleBlogModel();
		//Chargement du helper Form
		helper(['form']);
	}

	/**
	 * page par défaut
     * 
	 */
	public function index()
	{
		$articles = $this->articleBlogModele->findAll();
        return view('blog/index_article', ['titre' => 'blog', 'articles' => $articles]);
	}

	/**
	 * page détail d'un article
	 * @param int $idArticle
	 */
	public function voirArticle(int $idArticle)
	{
		$article = $this->articleBlogModele->find($idArticle);
        return view('blog/voir_article', ['titre' => 'blog', 'article' => $article]);
	}
}