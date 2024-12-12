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
			if (!$this->validate($this->borneModel->getValidationRules(), $this->borneModel->getValidationMessages())) {
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			else {
				$imageFile = $this->request->getFile('id_image'); // Le champ input file doit avoir le name="id_image"
				if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
					// Valider l'extension de l'image
					$allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
					$imageExtension = $imageFile->getClientExtension();
					if (!in_array($imageExtension, $allowedExtensions)) {
						return redirect()->back()->withInput()->with('errors', [
							'id_image' => "Format d'image non pris en charge. Formats acceptés : png, jpg, jpeg, gif.",
						]);
					}

					// Renommer le fichier avec un nom unique
					$imageName = "{$data['nom']}.$imageExtension";

					// Déplacer le fichier vers le dossier public/assets/option/
					$imagePath = "assets/images/bornes/$imageName";
					$imageFile->move(FCPATH . 'assets/images/bornes/', $imageName);

					// Ajouter une entrée dans la table image
					$imageData = ['chemin' => $imagePath];
					$this->imageModel->insert($imageData);

					// Récupérer l'ID de l'image insérée
					$imageId = $this->imageModel->getInsertID();
					if (!$imageId) {
						return redirect()->back()->withInput()->with('errors', [
							'id_image'=>"Échec de l'enregistrement de l'image."
						]);
					}

					// Ajouter l'ID de l'image dans les données de l'option
					$data['id_image'] = $imageId;


					$borne = new Borne();

					$borne->fill($data);
					$this->borneModel->insert($borne);
					$idBorne = $this->articleBlogModel->getInsertID();
					$data['nbJoueurs'] = $data['nbJoueurs'] ?? 1;
					$data['nbBoutons'] = $data['nbBoutons'] ?? 6;
					
					//$this->borneModel->insererJoystickBorne($idBorne, $data->joystick, $ordre);
					for ($i = 0; $i < $data['nbJoueurs']; $i++) {
						$this->borneModel->insererBoutonBorne($idBorne, $data['joystick'], $i);
					}
					for ($i = 0; $i < $data['nbBoutons']; $i++) {
						$this->borneModel->insererBoutonBorne($idBorne, $data['bouton'], $i);
					}

					//return redirect()->back()->with('success', "Borne ajouté avec succès.");
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
				} else {
					// Erreur lors du téléchargement de l'image
					return redirect()->back()->withInput()->with("errors", [
						'id_image'=>"Erreur lors du téléchargement de l'image.",
					]);
				}
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
				return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
			}
			$validationRules = [
				'titre' => 'required',
				'texte' => 'required',
				'images.0' => [
					'rules' => 'uploaded[images.0]|is_image[images.0]|ext_in[images.0,png,jpg,jpeg,gif]',
					'errors' => [
						'uploaded' => 'L\'image 1 est obligatoire.',
						'is_image' => 'L\'image 1 doit être une image valide.',
						'ext_in' => 'L\'image 1 doit avoir une extension valide (png, jpg, jpeg, gif).',
					],
				],
				// Pas de validation stricte pour les autres images
			];
		
			if (!$this->validate($validationRules)) {
				return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
			}

			$idUtilisateur = session()->get('user.id'); // Supposons que l'ID utilisateur est stocké dans la session
			if (!$idUtilisateur) {
				return redirect()->back()->with('error', 'Utilisateur non authentifié.');
			}

			// Créer une instance d'article
			$article = new ArticleBlog();
			$article->fill($data);
			$article->setIdUtilisateur($idUtilisateur);

			// Enregistrer l'article et récupérer son ID
			$this->articleBlogModel->insert($article);
			$idArticle = $this->articleBlogModel->getInsertID();

			if (!$idArticle) {
				return redirect()->back()->with('error', "Échec de l'enregistrement de l'article.");
			}

			$images = $this->request->getFiles(); // Supposons que le champ input multiple possède en tant qu'attribut name="images"
			if ($images) {
				$imageIndex = 1; // Compteur pour les noms d'images
				$uploadPath = FCPATH . "assets/images/blog/$idArticle/";

				// Créer le répertoire pour l'article si non existant
				if (!is_dir($uploadPath)) {
					mkdir($uploadPath, 0777, true);
				}

				foreach ($images['images'] as $image) {
					if ($image && $image->isValid() && !$image->hasMoved()) {
						// Vérifier les extensions autorisées
						$allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
						$imageExtension = $image->getClientExtension();
						if (!in_array($imageExtension, $allowedExtensions)) {
							return redirect()->back()->withInput()->with('errors', [
								'images' => 'Une ou plusieurs images ont un format non pris en charge.',
							]);
						}

						// Renommer l'image selon la convention "numAr{articleID}_{imageIndex}"
						$imageName = "numAr{$idArticle}_$imageIndex.$imageExtension";

						// Déplacer l'image vers le dossier
						$image->move($uploadPath, $imageName);

						// Ajouter l'image à la table Image
						$imageData = ['chemin' => "assets/images/blog/$idArticle/$imageName"];
						$this->imageModel->insert($imageData);
						$idImage = $this->imageModel->getInsertID();

						if ($idImage) {
							// Ajouter l'association image-article dans la table ImageArticleBlog
							$this->articleBlogModel->insererImageArticle($idArticle, $idImage);
						} else {
							return redirect()->back()->with('error', 'Échec de l\'enregistrement de l\'image.');
						}

						$imageIndex++; // Incrémenter l'indice pour le prochain fichier
						if ($imageIndex > 6) {
							break; // Limiter à 6 images maximum
						}
					}
				}
			}
			return redirect()->back()->with('success', 'Article ajouté avec succès.');
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
				$imageId = $this->imageModel->getInsertID();
				if (!$imageId) {
					return redirect()->back()->withInput()->with('errors', [
						'id_image' => "Échec de l'enregistrement de l'image.",
					]);
				}

				// Ajouter l'ID de l'image dans les données de l'option
				$data['id_image'] = $imageId;
				
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
