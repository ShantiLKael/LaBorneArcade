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
	 * @return string
	 */
	public function index()
	{
		return view('/'); //TODO je sais pas redirectionner 
	}

	/**
	 * Page contact version visiteur 
	 * @return string contact
	 */
	public function contact()
	{
		return view('/contact');
	}

    /**
     * Page visiteur de qui-sommes-nous
     * @return string qui-sommes-nous
     */
	public function quiSommesNous()
	{
		return view('/qui_sommes_nous');
	}

	/**
	 * Page visiteur faq
	 * @return string 
	 */
	public function faq()
	{
        $faqModele = new FaqModel();
		$faqs = $faqModele->findAllFaq();
		return view('faq')->with('faqs',"$faqs");
	}

    /**
	 * Page visiteur condition de vente
	 * @return string
	 */
	public function cgv()
	{
		return view('condition-de-vente');
	}

    /* ---------------------------------------- */
	/* ------------- ............ ------------- */
	/* ---------------------------------------- */

	

}