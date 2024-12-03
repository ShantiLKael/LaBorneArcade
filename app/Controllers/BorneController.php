<?php

namespace App\Controllers;

class ControleurHome extends BaseController
{
	/**
	 * Méthode qui affiche une interface de contact 
	 * pour joindre les administrateurs.
	 *
	 * @return string La vue de contact.
	 */
	public function contact(): string
	{
		return view('contact/index_contact', ['titre' => 'Me Contacter | LBA']);
	}
}
