<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederPrincipal extends Seeder {
	
	public function run(): void {
		$this->call('SeederUtilisateurs');
		$this->call('SeederArticlesBlog');
		$this->call('SeederThemes');
		$this->call('SeederTmoldings');
		$this->call('SeederBoutons');
		$this->call('SeederFaqs');
		$this->call('SeederImages');
		$this->call('SeederJoysticks');
		$this->call('SeederMatieres');
		$this->call('SeederOptions');
		$this->call('SeederBornes');
		$this->call('SeederBornesPerso');
		$this->call('SeederBoutonsBornes');
		$this->call('SeederCommandes');
		$this->call('SeederImagesArticlesBlog');
		$this->call('SeederImagesBornes');
		$this->call('SeederJoysticksBornes');
		$this->call('SeederOptionsBornes');
		$this->call('SeederPaniers');
	}
	
}
