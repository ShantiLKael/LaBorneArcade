<?php

namespace App\Controllers;

use App\Entities\ArticleBlog;
use App\Models\ArticleBlogModel;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class ArticleBlogController extends BaseController
{
	/**
	 * helper form
	 */
	public function __construct()
	{
		//Chargement du helper Form
		helper(['form']);
	}
	
	/**
	 * Page d'admin borne
	 * @return RedirectResponse admin/borne
	 */
	public function index(): RedirectResponse
	{
		return redirect()->to('/admin/bornes');
	}

	/**
	 * Page contact version admin (pas compris le pourquoi de cette page)
	 * @return RedirectResponse admin/contact
	 */
	public function adminContact(): RedirectResponse
	{
		return redirect()->to('/admin/contact');
	}

	/**
	 * Page admin des articles.
	 *
	 * @return RedirectResponse admin/articles
	 */
	public function adminArticle(): RedirectResponse
	{
		return redirect()->to('/admin/articles');
	}

	/**
	 * Page admin faq
	 * @return RedirectResponse
	 */
	public function adminFaq(): RedirectResponse
	{
		return redirect()->to('/admin/faqs');
	}
	
	/**
	 * Traitement d'ajout de nouveau article du blog.
	 *
	 * @return RedirectResponse
	 * @throws ReflectionException
	 */
	public function traitement_creation_article(): RedirectResponse
	{
		$validation = \Config\Services::validation();
		$articleBlogModel = new ArticleBlogModel();
		if (!$this->validate($articleBlogModel->getValidationRules(), $articleBlogModel->getValidationMessages())) {
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}
		
		/// Verifier la
		$data = $this->request->getPost();
		$articleBlog = new ArticleBlog();
		$articleBlog->fill($data);
		$articleBlogModel->insert($articleBlog);
		return redirect()->back();
	}

	/**
	 * Traitement de suppression de l'article en paramètre.
	 *
	 * @param int $idArticle
	 * @return RedirectResponse
	 */
	public function traitement_delete_article(int $idArticle): RedirectResponse
	{
		$articleBlogModel = new ArticleBlogModel();
		$articleBlogModel->deleteCascade($idArticle);
		return redirect()->back();
	}
	
	/**
	 * Traitement de modification de l'article en parametre
	 * @param int $idArticle
	 * @return RedirectResponse
	 * @throws ReflectionException
	 */
	public function traitement_modifier_article(int $idArticle): RedirectResponse
	{
		$articleBlogModel = new ArticleBlogModel();
		$data = $this->request->getPost();
		if (!$this->validate($articleBlogModel->getValidationRules(), $articleBlogModel->getValidationMessages()))
		{
			return redirect()->back()->withInput()->with('errors', $articleBlogModel->getErrors());
		}

		$article = $articleBlogModel->find($idArticle);

		// Mise à jour des propriétés
		$article->setTitre      ($data['titre']			?? $article->getTitre()       );
		$article->setPriorite   ($data['texte']		?? $article->getTexte()    );
		$article->setEcheance   ($data['idUtilisateur']		?? $article->getIdUtilisateur()    );
		$article->setModiffArticleBlog();

		// Enregistrer les modifications
		$articleBlogModel->save($article);
		
		return redirect()->back()->with('success', 'L\'article à été mises à jour.');
	}
}
