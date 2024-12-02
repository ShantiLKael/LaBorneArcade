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
    	echo view('commun/Navbar'); 
    	echo view('/admin/bornes'); 
    	echo view('commun/Footer'); 
	}

    public function adminContact()
	{
    	echo view('commun/Navbar'); 
    	echo view('/admin/contact'); 
    	echo view('commun/Footer'); 
	}

    public function adminArticle()
	{
    	echo view('commun/Navbar'); 
    	echo view('/admin/articles'); 
    	echo view('commun/Footer'); 
	}

    public function adminFaq()
	{
    	echo view('commun/Navbar'); 
    	echo view('/admin/faqs'); 
    	echo view('commun/Footer'); 
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
}