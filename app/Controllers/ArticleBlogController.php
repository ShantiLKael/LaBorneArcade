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
    	echo view('blog-articles'); 
    	echo view('commun/Footer'); 
	}

    public function voirArticle(int $idArticle)
	{
        $articleModele = new ArticleBlogModel();
		$article = $articleModele->find($idArticle)->getArticle();

        return redirect()->to('blog-articles/'.$idArticle)->with('article',"$article");
	}
	

	public function traitement_creation()
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