<?php

namespace App\Controllers;

use App\Entities\ArticleBlog;
use App\Entities\Faq;

use App\Entities\Theme;
use App\Models\ArticleBlogModel;
use App\Models\FaqModel;
use App\Models\ThemeModel;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Validation\ValidationInterface;
use Config\Services;
use ReflectionException;

class AdminController extends BaseController
{
	
	/** @var ArticleBlogModel $articleBlogModel */
	private ArticleBlogModel $articleBlogModel;
	
	/** @var FaqModel $faqModel */
	private FaqModel $faqModel;

    /** @var ThemeModel $themeModel */
    private ThemeModel $themeModel;
	
	/** @var ValidationInterface $validation */
	private ValidationInterface $validation;
	
	public function __construct() {
		$this->articleBlogModel = new ArticleBlogModel();
		$this->faqModel = new FaqModel();
        $this->themeModel = new ThemeModel();
		
		$this->validation = Services::validation();
		//Chargement du helper Form
		helper(['form']);
	}
	
    /* ---------------------------------------- */
	/* ----------- Redirection page ----------- */
	/* ---------------------------------------- */
	
	/**
	 * Page d'admin borne
	 * @return string admin/borne
	 */
	public function index(): string
	{
		return view('/admin/bornes');
	}

	/**
	 * Page contact version admin (pas compris le pourquoi de cette page)
	 * @return string admin/contact
	 */
	public function adminContact(): string
	{
		return view('/admin/contact');
	}

	/**
	 * Page admin des articles.
	 *
	 * @return string admin/articles
	 */
	public function adminArticle(): string
	{
		return view('/admin/articles');
	}

	/**
	 * Page admin faq
	 * @return string
	 */
	public function adminFaq(): string
	{
		return view('/admin/faqs');
	}

	public function adminTheme()
	{
		if ($this->request->getPost() ) {
			if ( ! $this->validate( $this->themeModel->getValidationRules(), $this->themeModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$data = $this->request->getPost();
				$theme = new Theme();
				$theme->fill($data);
				$this->themeModel->insert($theme);

				return redirect()->back()->with('success', "$theme->nom ajouté avec succès.");
			}
		} 
		$themes = $this->themeModel->findAll();
		$themes = array_reverse($themes);
		return view('admin/config_theme', ['titre' => 'configuration des theme', 'themes' => $themes]);
	}

    /* ---------------------------------------- */
	/* ------------- article/Blog ------------- */
	/* ---------------------------------------- */

	/**
	 * Traitement d'ajout de nouveau article du blog.
	 *
	 * @return RedirectResponse
	 * @throws ReflectionException
	 */
	public function traitement_creation_article(): RedirectResponse
	{
		if (!$this->validate($this->articleBlogModel->getValidationRules(), $this->articleBlogModel->getValidationMessages())) {
			return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
		}
		
		/// Verifier la
		$data = $this->request->getPost();
		$this->articleBlogModel->insert(new ArticleBlog($data));
		return redirect()->back();
	}

	/**
	 * Traitement de suppression de l'article en paramètre.
	 *
	 * @param int $id_article
	 * @return RedirectResponse
	 */
	public function traitement_delete_article(int $id_article): RedirectResponse
	{
		$this->articleBlogModel->delete($id_article);
		return redirect()->back();
	}
	
	/**
	 * Traitement de modification de l'article en paramètre.
	 *
	 * @param int $id_article
	 * @return RedirectResponse
	 * @throws ReflectionException
	 */
	public function traitement_modifier_article(int $id_article): RedirectResponse
	{
		$data = $this->request->getPost();
		if (!$this->validate($this->articleBlogModel->getValidationRules(), $this->articleBlogModel->getValidationMessages()))
		{
			return redirect()->back()->withInput()->with('erreurs', $this->validation->getErrors());
		}

		$article = $this->articleBlogModel->find($id_article);

		// Mise à jour des propriétés
		$article->setTitre      ($data['titre']			?? $article->getTitre()       );
		$article->setPriorite   ($data['texte']		?? $article->getTexte()    );
		$article->setEcheance   ($data['idUtilisateur']		?? $article->getIdUtilisateur()    );
		$article->setModiffArticleBlog();

		// Enregistrer les modifications
		$this->articleBlogModel->save($article);
		
		return redirect()->back()->with('succes', "L'article à été mis à jour.");
	}

    /* ---------------------------------------- */
	/* ------------------ FAQ ----------------- */
	/* ---------------------------------------- */
	
	/**
	 * Traitement d'ajout d'une nouvelle question de la faq.
	 *
	 * @return RedirectResponse
	 * @throws ReflectionException
	 */
	public function traitement_creation_faq(): RedirectResponse
	{
		if (!$this->validate($this->faqModel->getValidationRules(), $this->faqModel->getValidationMessages())) {
			return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
		}
		
		/// Verifier la
		$data = $this->request->getPost();
		$this->faqModel->insert(new Faq($data));
		return redirect()->back();
	}

	/**
	 * Traitement de suppression de la question faq en paramètre.
	 *
	 * @param int $id_faq
	 * @return RedirectResponse
	 */
	public function traitement_delete_faq(int $id_faq): RedirectResponse
	{
		$this->faqModel->delete($id_faq);
		return redirect()->back();
	}

    /* ---------------------------------------- */
	/* ----------------- theme ---------------- */
	/* ---------------------------------------- */


    /* ---------------------------------------- */
	/* ---------------- Matiere --------------- */
	/* ---------------------------------------- */

    
    /* ---------------------------------------- */
	/* ---------------- option ---------------- */
	/* ---------------------------------------- */


    /* ---------------------------------------- */
	/* --------------- joystick --------------- */
	/* ---------------------------------------- */


    /* ---------------------------------------- */
	/* --------------- Tmolding --------------- */
	/* ---------------------------------------- */


    /* ---------------------------------------- */
	/* ---------------- bouton ---------------- */
	/* ---------------------------------------- */


    /* ---------------------------------------- */
	/* ----------------- Borne ---------------- */
	/* ---------------------------------------- */

}

