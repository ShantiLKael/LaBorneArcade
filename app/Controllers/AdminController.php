<?php

namespace App\Controllers;

use App\Entities\ArticleBlog;
use App\Entities\Faq;

use App\Entities\Theme;
use App\Entities\Matiere;
use App\Entities\Option;
use App\Entities\Joystick;
use App\Entities\TMolding;
use App\Entities\Bouton;
use App\Entities\Image;

use App\Models\ArticleBlogModel;
use App\Models\FaqModel;
use App\Models\ThemeModel;
use App\Models\MatiereModel;
use App\Models\OptionModel;
use App\Models\JoystickModel;
use App\Models\TMoldingModel;
use App\Models\BoutonModel;
use App\Models\ImageModel;

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

	/** @var ImageModel $imageModel */
	private ImageModel $imageModel;
	
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
		$this->imageModel 		= new ImageModel();
		
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

	/* ---------------------------------------- */
	/* ------ Redirection page et ajout ------- */
	/* ---------------------------------------- */

	/**
	 * Page admin des articles
	 */
	public function adminArticle()
	{
		if ($this->request->getPost() ) {
			if ( ! $this->validate( $this->articleBlogModel->getValidationRules(), $this->articleBlogModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$data = $this->request->getPost();
				$article = new ArticleBlog();
				$article->fill($data);
				$this->articleBlogModel->insert($article);

				return redirect()->back()->with('success', "$article->titre ajouté avec succès.");
			}
		} 
		$articles = $this->articleBlogModel->findAll();
		$articles = array_reverse($articles);
		return view('admin/config_article', ['titre' => 'configuration des articles', 'articles' => $articles]);
	}

	/**
	 * Page admin faq
	 */
	public function adminFaq()
	{
		if ($this->request->getPost() ) {
			if ( ! $this->validate( $this->faqModel->getValidationRules(), $this->faqModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$data = $this->request->getPost();
				$faq = new Faq();
				
				$faq->fill($data);
				// dd(session()->get('user.id'));
				$faq->setIdUtilisateur(session()->get('user.id'));
				$this->faqModel->insert($faq);

				return redirect()->back()->with('success', "$faq->question ajouté avec succès.");
			}
		} 
		$faqs = $this->faqModel->findAll();
		$faqs = array_reverse($faqs);
		return view('admin/config_faq', ['titre' => 'configuration des FAQs', 'faqs' => $faqs]);
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
		if ($this->request->getPost()) {
			// Valider les données envoyées pour l'option
			if (!$this->validate($this->optionModel->getValidationRules(), $this->optionModel->getValidationMessages())) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}

			// Récupérer les données du formulaire
			$data = $this->request->getPost();

			// Gestion de l'image
			$imageFile = $this->request->getFile('id_image'); // Le champ input file doit avoir le name="id_image"
			if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
				// Valider l'extension de l'image
				$allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
				$imageExtension = $imageFile->getClientExtension();
				if (!in_array($imageExtension, $allowedExtensions)) {
					return redirect()->back()->withInput()->with('errors', [
						'id_image' => 'Format d\'image non pris en charge. Formats acceptés : png, jpg, jpeg, gif.',
					]);
				}

				// Renommer le fichier avec un nom unique
				$imageName = $data['nom'] . '.' . $imageExtension;

				// Déplacer le fichier vers le dossier public/assets/option/
				$imagePath = 'assets/images/option/' . $imageName;
				$imageFile->move(FCPATH . 'assets/images/option/', $imageName);

				// Ajouter une entrée dans la table image
				$imageData = ['chemin' => $imagePath];
				$this->imageModel->insert($imageData);

				// Récupérer l'ID de l'image insérée
				$imageId = $this->imageModel->insertID();
				if (!$imageId) {
					return redirect()->back()->withInput()->with('errors', [
						'id_image' => 'Échec de l\'enregistrement de l\'image.',
					]);
				}

				// Ajouter l'ID de l'image dans les données de l'option
				$data['id_image'] = $imageId;

				// Créer une nouvelle instance de l'option
				$option = new Option();
				$option->fill($data);

				// Insérer l'option dans la base de données
				$this->optionModel->insert($option);

				return redirect()->back()->with('success', "$option->nom ajouté avec succès.");
			} else {
				// Erreur lors du téléchargement de l'image
				return redirect()->back()->withInput()->with('errors', [
					'id_image' => 'Erreur lors du téléchargement de l\'image.',
				]);
			}
		}

		$options = $this->optionModel->getOptionsWithImages();

		// Récupérer les options pour les afficher dans la vue
		//$options = $this->optionModel->findAll();
		$options = array_reverse($options); // Afficher les options les plus récentes en haut
		return view('admin/config_option', [
			'titre' => 'Configuration des options',
			'options' => $options,
		]);
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
		return view('admin/config_tMolding', ['titre' => 'configuration des TMolding', 'tMoldings' => $tMoldings]);
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
				//dd($data);
				if ( !isset($data['eclairage']) ) {
					$data['eclairage'] = false;
				}
				$bouton->fill($data);
				$this->boutonModel->insert($bouton);

				return redirect()->back()->with('success', "$bouton->modele, $bouton->forme, $bouton->couleur ajouté avec succès."); 
			}
		} 
		$boutons = $this->boutonModel->findAll();
		$boutons = array_reverse($boutons);
		return view('admin/config_bouton', ['titre' => 'configuration des boutons', 'boutons' => $boutons]);
	}

	/* ---------------------------------------- */
	/* ------------- article/Blog ------------- */
	/* ---------------------------------------- */

	/**
	 * Traitement de suppression de l'article en paramètre.
	 *
	 * @param int $id_article
	 * @return RedirectResponse
	 */
	public function suppArticle(int $id_article): RedirectResponse
	{
		$id_article = $this->request->getPost('id');

		// Suppression du thème
		if ($this->articleBlogModel->delete($id_article)) { return redirect()->back()->with('success', 'Faq supprimé avec succès.'); }
		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression de la faq.']);
	}

	/* ---------------------------------------- */
	/* ------------------ FAQ ----------------- */
	/* ---------------------------------------- */


	/**
	 * Traitement de suppression de la question faq en paramètre.
	 *
	 * @param int $id_faq
	 * @return RedirectResponse
	 */
	public function suppFaq(int $id_faq): RedirectResponse
	{
		$id_faq = $this->request->getPost('id');

		// Suppression du thème
		if ($this->faqModel->delete($id_faq)) { return redirect()->back()->with('success', 'Faq supprimé avec succès.'); }
		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression de la faq.']);
	}

	/* ---------------------------------------- */
	/* ----------------- theme ---------------- */
	/* ---------------------------------------- */

	public function suppTheme( int $id_theme ): RedirectResponse
	{
		$id_theme = $this->request->getPost('id');

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

	public function suppMatiere( int $id_matiere ): RedirectResponse
	{
		$id_matiere = $this->request->getPost('id');

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

	public function suppOption(int $id_option): RedirectResponse
	{
		// Récupérer l'option depuis la base de données
		$option = $this->optionModel->find($id_option);

		if ($option) {
			$imagePath = realpath("..")."/public/".$this->imageModel->find($option->id_image)->chemin; 
			if (file_exists($imagePath)) {
				unlink($imagePath);
			} 
			$nom = $option->nom;
			if ($this->optionModel->delete($id_option)) {
				$this->imageModel->where('chemin', $imagePath)->delete();
				return redirect()->back()->with('success', "$nom et image supprimées avec succès.");
			}
		}

		// En cas d'erreur (si l'option n'existe pas ou si la suppression échoue)
		return redirect()->back()->with('errors', ['Erreur lors de la suppression de l\'option et de l\'image.']);
	}

	/* ---------------------------------------- */
	/* --------------- joystick --------------- */
	/* ---------------------------------------- */

	public function suppJoystick( int $id_joystick ): RedirectResponse
	{
		$id_joystick = $this->request->getPost('id');

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

	public function suppTmolding( int $id_tmolding ): RedirectResponse
	{
		$id_tmolding = $this->request->getPost('id');

		// Suppression du thème
		if ($this->tMoldingModel->delete($id_tmolding)) {
			return redirect()->back()->with('success', 'Tmolding supprimé avec succès.');
		}

		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression du Tmolding.']);
	}

	/* ---------------------------------------- */
	/* ---------------- bouton ---------------- */
	/* ---------------------------------------- */

	public function suppBouton( int $id_bouton ): RedirectResponse
	{
		$id_bouton = $this->request->getPost('id');

		// Suppression du thème
		if ($this->boutonModel->delete($id_bouton)) {
			return redirect()->back()->with('success', 'Bouton supprimé avec succès.');
		}

		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression de la bouton.']);
	}

	/* ---------------------------------------- */
	/* ----------------- Borne ---------------- */
	/* ---------------------------------------- */

}