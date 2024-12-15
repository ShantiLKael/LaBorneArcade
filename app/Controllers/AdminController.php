<?php

namespace App\Controllers;

use App\Entities\ArticleBlog;
use App\Entities\Faq;

use App\Entities\Theme;
use App\Entities\Matiere;
use App\Entities\Option;
use App\Entities\Joystick;
use App\Entities\TMolding;
use App\Entities\Borne;
use App\Entities\Bouton;

use App\Models\ArticleBlogModel;
use App\Models\FaqModel;
use App\Models\ThemeModel;
use App\Models\MatiereModel;
use App\Models\OptionModel;
use App\Models\JoystickModel;
use App\Models\TMoldingModel;
use App\Models\BoutonModel;
use App\Models\BorneModel;
use App\Models\ImageModel;

use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Validation\ValidationInterface;
use Config\Services;
use ReflectionException;

class AdminController extends BaseController
{
	
	private ArticleBlogModel $articleBlogModel;
	
	private FaqModel $faqModel;
	
	private ThemeModel $themeModel;
	
	private MatiereModel $matiereModel;
	
	private OptionModel $optionModel;
	
	private JoystickModel $joystickModel;
	
	private TMoldingModel $tMoldingModel;
	
	private BoutonModel $boutonModel;
	
	private BorneModel $borneModel;
	
	private ImageModel $imageModel;
	
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
		$this->borneModel 		= new BorneModel();
		$this->imageModel 		= new ImageModel();
		
		$this->validation = Services::validation();
		// Chargement du helper Form
		helper(['form']);
	}
	
	/* ---------------------------------------- */
	/* ------- Redirection page simple -------- */
	/* ---------------------------------------- */

	/**
	 * Page contact version admin
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
	 * Page d'admin borne.
	 *
	 * @throws ReflectionException
	 */
	public function adminBorne(): RedirectResponse|string
	{
		$data = $this->request->getPost();
		if ($data) {
			

			if (isset($data['nbBoutons']) || isset($data['nbJoueurs'])) {
				$nbBoutons = intval($data['nbBoutons']);
				$nbJoueurs = intval($data['nbJoueurs']);
	
				return view('admin/config_borne', [
					'nbJoueurs'=> $nbJoueurs,
					'nbBoutons'=> $nbBoutons,
					'titre'    => "Création d'une borne",
					'matieres' => $this->matiereModel->findAll(),
					'options'  => $this->optionModel->findAll(),
					'themes'   => $this->themeModel->findAll(),
					'tmoldings'=> $this->tMoldingModel->findAll(),
					'joysticks'=> $this->joystickModel->findAll(),
					'boutons'  => $this->boutonModel->findAll(),
				]);
			}

			if (!$this->validate($this->borneModel->getValidationRules(), $this->borneModel->getValidationMessages())) {

			} else {
				
				$borne = new Borne();

				$borne->fill($data);
				$idBorne = $this->borneModel->insert($borne);

				$images = $this->request->getFileMultiple('images');
				$idImages = [];

				foreach ($images as $image) {
					$imageUploader = service('imageUploader');
					$idImage = $imageUploader->enregistrerImage($image, getenv('CHEMIN_BORNE').$idBorne.'/');

					if ($idImage == 0) {
						$this->borneModel->find($idBorne)->delete();
						
						return view('admin/config_borne', [
							'nbJoueurs'=> 1,
							'nbBoutons'=> 6,
							'titre'    => "Création d'une borne",
							'matieres' => $this->matiereModel->findAll(),
							'options'  => $this->optionModel->findAll(),
							'themes'   => $this->themeModel->findAll(),
							'tmoldings'=> $this->tMoldingModel->findAll(),
							'joysticks'=> $this->joystickModel->findAll(),
							'boutons'  => $this->boutonModel->findAll(),
						]);
					}

					$idImages[] = $idImage;
				}
				
				$data['nbJoueurs'] = $data['nbJoueurs'] ?? 1;
				$data['nbBoutons'] = $data['nbBoutons'] ?? 6;

				for ($i = 1; $i <= $data['nbJoueurs']; $i++)
					$this->borneModel->insererJoystickBorne($idBorne, $data['joystick'], $i);

				for ($i = 1; $i <= $data['nbBoutons']; $i++)
					$this->borneModel->insererBoutonBorne($idBorne, $data['bouton'], $i);

				foreach ($idImages as $idImage)
					$this->borneModel->insererImageBorne($idBorne, $idImage);
			}
		}

		return view('/admin/config_borne', [
			'titre'    => "Création d'une borne",
			'nbJoueurs'=> 1,
			'nbBoutons'=> 6,
			'matieres' => $this->matiereModel->findAll(),
			'options'  => $this->optionModel->findAll(),
			'themes'   => $this->themeModel->findAll(),
			'tmoldings'=> $this->tMoldingModel->findAll(),
			'joysticks'=> $this->joystickModel->findAll(),
			'boutons'  => $this->boutonModel->findAll(),
		]);
	}
	
	/**
	 * Page admin des articles
	 * @throws ReflectionException
	 */
	public function adminArticle()
	{
		$data = $this->request->getPost();
		if ($data) {
			if (!$this->validate($this->articleBlogModel->getValidationRules(), $this->articleBlogModel->getValidationMessages())) {
				return redirect()->to('/admin/articles')->with('errors', $this->validation->getErrors());
			}

			// Créer une instance d'article
			$article = new ArticleBlog();
			$article->fill($data);
			$article->idUtilisateur = session()->get('user')['id'];

			// Enregistrer l'article et récupérer son ID
			$idArticle = $this->articleBlogModel->insert($article, true);

			$images = $this->request->getFileMultiple('images');
			$idImages = [];

			foreach ($images as $image) {
				$imageUploader = service('imageUploader');
				$idImage = $imageUploader->enregistrerImage($image, getenv('CHEMIN_BLOG').$idArticle.'/');

				if ($idImage == 0) {
					$this->articleBlogModel->find($idArticle)->delete();
					
					return view('admin/config_borne', [
						'nbJoueurs'=> 1,
						'nbBoutons'=> 6,
						'titre'    => "Création d'une borne",
						'matieres' => $this->matiereModel->findAll(),
						'options'  => $this->optionModel->findAll(),
						'themes'   => $this->themeModel->findAll(),
						'tmoldings'=> $this->tMoldingModel->findAll(),
						'joysticks'=> $this->joystickModel->findAll(),
						'boutons'  => $this->boutonModel->findAll(),
					]);
				}

				$idImages[] = $idImage;
			}

			foreach ($idImages as $idImage)
				$this->articleBlogModel->insererImageArticle($idArticle, $idImage);

			return redirect()->to('/admin/articles')->with('success', 'Article ajouté avec succès.');
		}

		//$options = $this->optionModel->getOptionsWithImages();

		// Récupérer les options pour les afficher dans la vue
		//$options = $this->optionModel->findAll();
		//$options = array_reverse($options); // Afficher les options les plus récentes en haut

		$articles = $this->articleBlogModel->findAll();
		$articles = array_reverse($articles);
		return view('admin/config_article', [
			'titre'   =>"Configuration des articles",
			'articles'=>$articles
		]);
	}
	
	/**
	 * Page admin faq
	 *
	 * @throws ReflectionException
	 */
	public function adminFaq()
	{
		$data = $this->request->getPost();
		if ($data) {
			if ( ! $this->validate( $this->faqModel->getValidationRules(), $this->faqModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$faq = new Faq($data);
				$faq->setIdUtilisateur(session()->get('user.id'));
				$this->faqModel->insert($faq);

				return redirect()->back()->with('success', "$faq->question ajouté avec succès.");
			}
		}
		$faqs = $this->faqModel->findAll();
		$faqs = array_reverse($faqs);
		return view('admin/config_faq', [
			'titre'=>'Configuration des FAQs',
			'faqs' =>$faqs
		]);
	}
	
	/**
	 * @throws ReflectionException
	 */
	public function adminTheme()
	{
		$data = $this->request->getPost();
		if ($data) {
			if ( ! $this->validate( $this->themeModel->getValidationRules(), $this->themeModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$this->themeModel->insert(new Theme($data));
				return redirect()->back()->with('success', "{$data['nom']} ajouté avec succès.");
			}
		}
		$themes = $this->themeModel->findAll();
		$themes = array_reverse($themes);
		return view('admin/config_theme', ['titre' => 'configuration des theme', 'themes' => $themes]);
	}
	
	/**
	 * @throws ReflectionException
	 */
	public function adminMatiere()
	{
		$data = $this->request->getPost();
		if ($data) {
			if ( ! $this->validate( $this->matiereModel->getValidationRules(), $this->matiereModel->getValidationMessages() ) ) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$this->matiereModel->insert(new Matiere($data));
				return redirect()->back()->with('success', "{$data['nom']}, {$data['couleur']} ajouté avec succès.");
			}
		}
		$matieres = $this->matiereModel->findAll();
		$matieres = array_reverse($matieres);
		return view('admin/config_matiere', ['titre' => 'configuration des matiere', 'matieres' => $matieres]);
	}
	
	/**
	 * @throws ReflectionException
	 */
	public function adminOption()
	{
		$data = $this->request->getPost();
		if ($data) {
			// Valider les données envoyées pour l'option
			if (!$this->validate($this->optionModel->getValidationRules(), $this->optionModel->getValidationMessages())) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			
			// Gestion de l'image
			$imageFile = $this->request->getFile('id_image'); // Le champ input file doit avoir le name="id_image"
			if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
				
				$imageUploader = service('imageUploader');
				$idImage = $imageUploader->enregistrerImage($imageFile, getenv('CHEMIN_OPTION'));

				if ($idImage == 0) {
					return redirect()->back()->withInput()->with('errors', [
						'id_image' => "Échec de l'enregistrement de l'image.",
					]);
				}

				// Ajouter l'ID de l'image dans les données de l'option
				$data['id_image'] = $idImage;
				
				// Insérer l'option dans la base de données
				$this->optionModel->insert(new Option($data));

				return redirect()->back()->with('success', "{$data['nom']} ajouté avec succès.");
			} else {
				// Erreur lors du téléchargement de l'image
				return redirect()->back()->withInput()->with('errors', [
					'id_image' => 'Erreur lors du téléchargement de l\'image.',
				]);
			}
		}

		// Récupérer les options pour les afficher dans la vue
		return view('admin/config_option', [
			'titre'  =>'Configuration des options',
			'options'=>array_reverse($this->optionModel->getOptionsWithImages()),
		]);
	}
	
	
	/**
	 * @throws ReflectionException
	 */
	public function adminJoystick()
	{
		$data = $this->request->getPost();
		if ($data) {
			if (!$this->validate($this->joystickModel->getValidationRules(), $this->joystickModel->getValidationMessages())) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			} else {
				$this->joystickModel->insert(new Joystick($data));
				return redirect()->back()->with('success', "{$data['modele']}, {$data['couleur']} ajouté avec succès.");
			}
		}
		return view('admin/config_joystick', [
			'titre'    =>"Configuration des joystick",
			'joysticks'=>array_reverse($this->joystickModel->findAll())
		]);
	}
	
	/**
	 * @throws ReflectionException
	 */
	public function adminTMolding(): RedirectResponse|string
	{
		$data = $this->request->getPost();
		if ($data) {
			if (!$this->validate($this->tMoldingModel->getValidationRules(), $this->tMoldingModel->getValidationMessages())) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			} else {
				$this->tMoldingModel->insert(new TMolding($data));
				return redirect()->back()->with('success', "{$data['nom']}, {$data['couleur']} ajouté avec succès.");
			}
		}
		return view('admin/config_tMolding', [
			'titre'    =>"Configuration des TMolding",
			'tMoldings'=>array_reverse($this->tMoldingModel->findAll())
		]);
	}
	
	/**
	 * @throws ReflectionException
	 */
	public function adminBouton()
	{
		$data = $this->request->getPost();
		if ($data) {
			if (!$this->validate($this->boutonModel->getValidationRules(), $this->boutonModel->getValidationMessages())) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			} else {
				$data['eclairage'] = $data['eclairage'] ?? false;
				$this->boutonModel->insert(new Bouton($data));
				return redirect()->back()->with('success', "{$data['modele']}, {$data['forme']}, {$data['couleur']} ajouté avec succès.");
			}
		}
		return view('admin/config_bouton', [
			'titre'  =>"Configuration des boutons",
			'boutons'=>array_reverse($this->boutonModel->findAll())
		]);
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
		// Récupérer l'article depuis la base de données
		$article = $this->articleBlogModel->find($id_article);
		if ($article) {
			// Récupérer toutes les images associées à l'article
			$images = $this->imageModel
				->join('imagearticleblog', 'image.id_image = imagearticleblog.id_image')
				->where('imagearticleblog.id_articleblog', $id_article)
				->findAll();

			// Définir le chemin du répertoire de l'article
			$articleDir = FCPATH . "assets/images/blog/$id_article";

			// Supprimer les fichiers d'images associés
			foreach ($images as $image) {
				// Assurez-vous d'accéder à la propriété de l'objet Image correctement
				$imagePath = FCPATH . $image->chemin; // Utilisez -> au lieu de ['chemin']
				if (file_exists($imagePath)) { unlink($imagePath); }
			}

			// Supprimer le répertoire de l'article s'il existe
			if (is_dir($articleDir)) { rmdir($articleDir); }

			// Supprimer les associations dans la table `imagearticleblog`
			$this->articleBlogModel->suppImageArticle($id_article);

			// Supprimer les images associées dans la table `image`
			foreach ($images as $image) {
				$this->imageModel->delete($image->id_image);
			}

			// Supprimer l'article lui-même
			$titre = $article->titre; // Conserver le titre pour la notification
			if ($this->articleBlogModel->delete($id_article)) { return redirect()->back()->with('success', "L'article '$titre' et ses images ont été supprimés avec succès.");}
		}
		// En cas d'erreur (si l'article n'existe pas ou si la suppression échoue).
		return redirect()->back()->with('errors', ["Erreur lors de la suppression de l'article et de ses images."]);
	}

	/* ---------------------------------------- */
	/* ------------------ FAQ ----------------- */
	/* ---------------------------------------- */

	/**
	 * Traitement de suppression de la question faq en paramètre.
	 *
	 * @return RedirectResponse
	 */
	public function suppFaq(): RedirectResponse
	{
		$id_faq = $this->request->getPost('id');

		// Suppression du thème
		if ($this->faqModel->delete($id_faq))
			return redirect()->back()->with('success', 'Question de FAQ supprimée avec succès.');
		// En cas d'erreur
		return redirect()->back()->with('errors', ["Erreur lors de la suppression de la question."]);
	}

	/* ---------------------------------------- */
	/* ----------------- theme ---------------- */
	/* ---------------------------------------- */

	public function suppTheme(): RedirectResponse
	{
		$id_theme = $this->request->getPost('id');

		// Suppression du thème
		if ($this->themeModel->delete($id_theme))
			return redirect()->back()->with('success', 'Thème supprimé avec succès.');
		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression du thème.']);
	}

	/* ---------------------------------------- */
	/* ---------------- Matiere --------------- */
	/* ---------------------------------------- */

	public function suppMatiere(): RedirectResponse
	{
		$id_matiere = $this->request->getPost('id');

		// Suppression du thème
		if ($this->matiereModel->delete($id_matiere))
			return redirect()->back()->with('success', 'Matière supprimée avec succès.');

		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression de la matière.']);
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
			if (file_exists($imagePath)) { unlink($imagePath); }
			$nom = $option->nom;
			$id_im =$option->id_image;
			if ($this->optionModel->delete($id_option)) {
				$this->imageModel->where('chemin', $imagePath)->delete();
				$this->imageModel->delete($id_im);
				return redirect()->back()->with('success', "Option $nom et image supprimées avec succès.");
			}
		}

		// En cas d'erreur, si l'option n'existe pas ou si la suppression échoue.
		return redirect()->back()->with('errors', ["Erreur lors de la suppression de l'option et de l'image."]);
	}

	/* ---------------------------------------- */
	/* --------------- joystick --------------- */
	/* ---------------------------------------- */

	public function suppJoystick(): RedirectResponse
	{
		$id_joystick = $this->request->getPost('id');

		// Suppression du thème
		if ($this->joystickModel->delete($id_joystick))
			return redirect()->back()->with('success', 'Joystick supprimé avec succès.');
		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression du joystick.']);
	}

	/* ---------------------------------------- */
	/* --------------- Tmolding --------------- */
	/* ---------------------------------------- */

	public function suppTmolding(): RedirectResponse
	{
		$id_tmolding = $this->request->getPost('id');

		// Suppression du thème
		if ($this->tMoldingModel->delete($id_tmolding))
			return redirect()->back()->with('success', 'Tmolding supprimé avec succès.');
		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression du Tmolding.']);
	}

	/* ---------------------------------------- */
	/* ---------------- bouton ---------------- */
	/* ---------------------------------------- */
	
	/**
	 * @return RedirectResponse
	 */
	public function suppBouton(): RedirectResponse
	{
		$id_bouton = $this->request->getPost('id');

		// Suppression du thème
		if ($this->boutonModel->delete($id_bouton))
			return redirect()->back()->with('success', 'Bouton supprimé avec succès.');
		// En cas d'erreur
		return redirect()->back()->with('errors', ['Erreur lors de la suppression du bouton.']);
	}

	/* ---------------------------------------- */
	/* ----------------- Borne ---------------- */
	/* ---------------------------------------- */

}
