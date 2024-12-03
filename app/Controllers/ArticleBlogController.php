<?php

namespace App\Controllers;

use App\Models\ArticleBlogModel;

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
	 * Page par défaut
	 *
	 * @return string blog-articles version potentiel acheteur
	 */
	public function index(): string
	{
		$articles = $this->articleBlogModele->findAll();
		return view('blog-articles', ['articles' => $articles]);
	}

	/**
	 * Page détail d'un article
	 *
	 * @param int $id_article
	 * @return string
	 */
	public function voirArticle(int $id_article): string
	{
//		dd($id_article, $this->articleBlogModele->find($id_article));
		$articles = $this->articleBlogModele->find($id_article)->getArticle();
		return view('blog-articles'.$id_article, ['articles' => $articles]);
	}
}
