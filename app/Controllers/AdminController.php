<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Entities\ArticleBlog;
use App\Models\UtilisateurModel;
use App\Models\ArticleBlogModel;
use CodeIgniter\Model;

class ArticleBlogController extends BaseController
{

    /* ---------------------------------------- */
	/* ----------- Redirection page ----------- */
	/* ---------------------------------------- */
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
	 * @return string admin/borne
	 */
	public function index()
	{
		return view('/admin/bornes');
	}

	/**
	 * Page contact version admin (pas compris le pourquoi de cette page)
	 * @return string admin/contact
	 */
	public function adminContact()
	{
		return view('/admin/contact');
	}

	/**
	 * Page admin des article
	 * @return string admin/articles
	 */
	public function adminArticle()
	{
		return view('/admin/articles');
	}

	/**
	 * Page admin faq
	 * @return string
	 */
	public function adminFaq()
	{
		return view('/admin/faqs');
	}

    /* ---------------------------------------- */
	/* ------------- article/Blog ------------- */
	/* ---------------------------------------- */

	/**
	 * traitement d'ajout de nouveau article du blog
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function traitement_creation_article()
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
	 * Traitement de suppression de l'article en parametre
	 * @param int $idArticle 
	 * @return \CodeIgniter\HTTP\RedirectResponse 
	 */
	public function traitement_delete_article(int $idArticle)
	{
		$articleBlogModel = new ArticleBlogModel();
		$articleBlogModel->deleteCascade($idArticle);
		return redirect()->back();
	}

	/**
	 * Traitement de modification de l'article en parametre
	 * @param int $idArticle
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function traitement_modifier_article(int $idArticle)
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

    /* ---------------------------------------- */
	/* ------------------ FAQ ----------------- */
	/* ---------------------------------------- */

    /**
	 * traitement d'ajout d'une nouvelle question de la faq
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function traitement_creation_faq()
	{
		$validation = \Config\Services::validation();
		$faqModel = $faq = new FaqModel();
		if (!$this->validate($faqModel->getValidationRules(), $faqModel->getValidationMessages())) {
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}
		
		/// Verifier la
		$data = $this->request->getPost();
		$faq->fill($data);
		$faqModel->insert($faq);
		return redirect()->back();
	}

	/**
	 * Traitement de suppression de la question faq en parametre
	 * @param int $idfaq 
	 * @return \CodeIgniter\HTTP\RedirectResponse 
	 */
	public function traitement_delete_faq(int $idfaq)
	{
		$faqModel = new ArticleBlogModel();
		$faqModel->deleteCascade($idfaq);
		return redirect()->back();
	}

    /* ---------------------------------------- */
	/* ----------------- Borne ---------------- */
	/* ---------------------------------------- */

}