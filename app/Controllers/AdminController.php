<?php

namespace App\Controllers;

use App\Entities\ArticleBlog;
use App\Entities\Faq;

use App\Entities\Theme;
use App\Models\ArticleBlogModel;
use App\Models\FaqModel;
use App\Models\ThemeModel;
use App\Models\MatiereModel;
use App\Models\OptionModel;
use App\Models\JoystickModel;
use App\Models\TMoldingModel;
use App\Models\BoutoneModel;

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

	/** @var MatiereModel $matiereModel */
    private MatiereModel $matiereModel;

	/** @var OptionModel $optionModel */
    private OptionModel $optionModel;

	/** @var JoystickModel $joystickModel */
    private JoystickModel $joystickModel;

	/** @var TMoldingModel $tMoldingModel */
    private TMoldingModel $tMoldingModel;

	/** @var BoutonModel $boutonModel */
    private BoutonModel $boutonModel;
	
	/** @var ValidationInterface $validation */
	private ValidationInterface $validation;
	
	public function __construct() {
		$this->articleBlogModel	= new ArticleBlogModel();
		$this->faqModel			= new FaqModel();
        $this->themeModel	 	= new ThemeModel();
        $this->matiereModel 	= new MatiereModel();
        $this->optionModel 		= new OptionModel();
        $this->joystickModel 	= new JoystickModel();
        $this->tMoldingModel 	= new TMoldingModel();
        $this->boutonModel 		= new BoutonModel();
		
		$this->validation = Services::validation();
		//Chargement du helper Form
		helper(['form']);
	}
	
    /* ---------------------------------------- */
	/* ------- Redirection page simple -------- */
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

	/* ---------------------------------------- */
	/* ------ Redirection page et ajout ------- */
	/* ---------------------------------------- */

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

	public function adminMatiere()
	{
		if ($this->request->getPost() ) {
			if ( ! $this->validate( $this->matiereModel->getValidationRules(), $this->matiereModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$data = $this->request->getPost();
				$matiere = new Matiere();
				$matiere->fill($data);
				$this->matiereModel->insert($matiere);

				return redirect()->back()->with('success', "$matiere->nom, $matiere->couleur ajouté avec succès.");
			}
		} 
		$matieres = $this->matiereModel->findAll();
		$matieres = array_reverse($matieres);
		return view('admin/config_matiere', ['titre' => 'configuration des matiere', 'matieres' => $matieres]);
	}

	public function adminOption()
	{
		if ($this->request->getPost() ) {
			if ( ! $this->validate( $this->optionModel->getValidationRules(), $this->optionModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$data = $this->request->getPost();
				$option = new Option();
				$option->fill($data);
				$this->optionModel->insert($option);

				return redirect()->back()->with('success', "$option->nom, $option->cout ajouté avec succès.");
			}
		} 
		$options = $this->optionModel->findAll();
		$options = array_reverse($options);
		return view('admin/config_option', ['titre' => 'configuration des options', 'options' => $options]);
	}

	public function adminJoystick()
	{
		if ($this->request->getPost() ) {
			if ( ! $this->validate( $this->joystickModel->getValidationRules(), $this->joystickModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$data = $this->request->getPost();
				$joystick = new Joystick();
				$joystick->fill($data);
				$this->joystickModel->insert($joystick);

				return redirect()->back()->with('success', "$joystick->modele , $joystick->couleur ajouté avec succès.");
			}
		} 
		$joysticks = $this->joystickModel->findAll();
		$joysticks = array_reverse($joysticks);
		return view('admin/config_joystick', ['titre' => 'configuration des joystick', 'joysticks' => $joysticks]);
	}

	public function adminTMolding()
	{
		if ($this->request->getPost() ) {
			if ( ! $this->validate( $this->tMoldingModel->getValidationRules(), $this->tMoldingModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$data = $this->request->getPost();
				$tMolding = new TMolding();
				$tMolding->fill($data);
				$this->tMoldingModel->insert($tMolding);

				return redirect()->back()->with('success', "$tMolding->nom, $tMolding->couleur ajouté avec succès.");
			}
		} 
		$tMoldings = $this->tMoldingModel->findAll();
		$tMoldings = array_reverse($tMoldings);
		return view('admin/config_tMolding', ['titre' => 'configuration des tMolding', 'tMoldings' => $tMoldings]);
	}

	public function adminBouton()
	{
		if ($this->request->getPost() ) {
			if ( ! $this->validate( $this->boutonModel->getValidationRules(), $this->boutonModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$data = $this->request->getPost();
				$bouton = new Bouton();
				$bouton->fill($data);
				$this->boutonModel->insert($bouton);

				return redirect()->back()->with('success', "$bouton->modele, $bouton->forme, $bouton->couleur ajouté avec succès."); 
			}
		} 
		$boutons = $this->boutonModel->findAll();
		$boutons = array_reverse($boutons);
		return view('admin/config_bouton', ['titre' => 'configuration des boutons', 'boutons' => $matiboutonseres]);
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

	public function suppTheme(): RedirectResponse
	{
		$id_theme = $this->request->getPost('id');

		if (empty($id_theme) || !$this->themeModel->find($id_theme)) {
			return redirect()->back()->with('errors', ['Thème introuvable ou ID invalide.']);
		}

		// Suppression du thème
		if ($this->themeModel->delete($id_theme)) {
			return redirect()->back()->with('success', 'Thème supprimé avec succès.');
		}

		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression du thème.']);
	}


    /* ---------------------------------------- */
	/* ---------------- Matiere --------------- */
	/* ---------------------------------------- */

	public function suppMatiere(): RedirectResponse
	{
		$id_matiere = $this->request->getPost('id');

		if (empty($id_matiere) || !$this->matiereModel->find($id_matiere)) {
			return redirect()->back()->with('errors', ['Matiere introuvable ou ID invalide.']);
		}

		// Suppression du thème
		if ($this->matiereModel->delete($id_matiere)) {
			return redirect()->back()->with('success', 'Matiere supprimé avec succès.');
		}

		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression de la matiere.']);
	}

    
    /* ---------------------------------------- */
	/* ---------------- option ---------------- */
	/* ---------------------------------------- */

	public function suppOption(): RedirectResponse
	{
		$id_option = $this->request->getPost('id');

		if (empty($id_option) || !$this->optionModel->find($id_option)) {
			return redirect()->back()->with('errors', ['Option introuvable ou ID invalide.']);
		}

		// Suppression du thème
		if ($this->optionModel->delete($id_option)) {
			return redirect()->back()->with('success', 'Option supprimé avec succès.');
		}

		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression de l\'option.']);
	}


    /* ---------------------------------------- */
	/* --------------- joystick --------------- */
	/* ---------------------------------------- */

	public function suppJoystick(): RedirectResponse
	{
		$id_joystick = $this->request->getPost('id');

		if (empty($id_joystick) || !$this->joystickModel->find($id_joystick)) {
			return redirect()->back()->with('errors', ['Joystick introuvable ou ID invalide.']);
		}

		// Suppression du thème
		if ($this->joystickModel->delete($id_joystick)) {
			return redirect()->back()->with('success', 'Joystick supprimé avec succès.');
		}

		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression de la joystick.']);
	}


    /* ---------------------------------------- */
	/* --------------- Tmolding --------------- */
	/* ---------------------------------------- */

	public function suppTmolding(): RedirectResponse
	{
		$id_tmolding = $this->request->getPost('id');

		if (empty($id_tmolding) || !$this->TmoldingModel->find($id_tmolding)) {
			return redirect()->back()->with('errors', ['Tmolding introuvable ou ID invalide.']);
		}

		// Suppression du thème
		if ($this->TmoldingModel->delete($id_tmolding)) {
			return redirect()->back()->with('success', 'Tmolding supprimé avec succès.');
		}

		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression du Tmolding.']);
	}


    /* ---------------------------------------- */
	/* ---------------- bouton ---------------- */
	/* ---------------------------------------- */

	public function suppBouton(): RedirectResponse
	{
		$id_bouton = $this->request->getPost('id');

		if (empty($id_bouton) || !$this->BoutonModel->find($id_bouton)) {
			return redirect()->back()->with('errors', ['Bouton introuvable ou ID invalide.']);
		}

		// Suppression du thème
		if ($this->BoutonModel->delete($id_bouton)) {
			return redirect()->back()->with('success', 'Bouton supprimé avec succès.');
		}

		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression de la bouton.']);
	}


    /* ---------------------------------------- */
	/* ----------------- Borne ---------------- */
	/* ---------------------------------------- */

}

