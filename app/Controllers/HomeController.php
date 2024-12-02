<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\FaqModel;
use CodeIgniter\Model;

class HomeController extends BaseController
{

    /* ---------------------------------------- */
	/* ----------- Redirection page ----------- */
	/* ---------------------------------------- */
	
	/**
	 * Page ..........
	 * @return \CodeIgniter\HTTP\RedirectResponse 
	 */
	public function index()
	{
		return redirect()->to('/'); //TODO je sais pas redirectionner 
	}

	/**
	 * Page contact version visiteur 
	 * @return \CodeIgniter\HTTP\RedirectResponse contact
	 */
	public function contact()
	{
		return redirect()->to('/contact');
	}

	/**
	 * Page visiteur de qui-sommes-nous
	 * @return \CodeIgniter\HTTP\RedirectResponse qui-sommes-nous
	 */
	public function quiSommesNous()
	{
		return redirect()->to('/qui-sommes-nous');
	}

	/**
	 * Page visiteur faq
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function faq()
	{
        $faqModele = new FaqModel();
		$faqs = $faqModele->findAllFaq();
		return redirect()->to('faq')->with('faqs',"$faqs");
	}

    /**
	 * Page visiteur condition de vente
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function cgv()
	{
		return redirect()->to('condition-de-vente');
	}

    /* ---------------------------------------- */
	/* ------------- ............ ------------- */
	/* ---------------------------------------- */

	

}