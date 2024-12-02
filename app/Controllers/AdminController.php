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
	
	public function index()
	{
		return redirect()->to('/admin/bornes');
	}

	public function adminContact()
	{
		return redirect()->to('/admin/contact');
	}

	public function adminArticle()
	{
		return redirect()->to('/admin/articles');
	}

	public function adminFaq()
	{
		return redirect()->to('/admin/faqs');
	}


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

	public function traitement_delete_article(int $idArticle)
	{
		$articleBlogModel = new ArticleBlogModel();
		$articleBlogModel->deleteCascade($idArticle);
		return redirect()->back();
	}

	public function traitement_modifier_article(int $idArticle)
	{
		$articleBlogModel = new ArticleBlogModel();
		$articleBlogModel->deleteCascade($idArticle);
		return redirect()->back();
	}
}