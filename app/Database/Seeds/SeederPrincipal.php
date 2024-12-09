<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Laminas\Escaper\Exception\InvalidArgumentException;

class SeederPrincipal extends Seeder {
	
	public function run(): void {
		$seeders = [
			'Utilisateurs',
			'ArticlesBlog',
			'Themes',
			'Tmoldings',
			'Boutons',
			'Faqs',
			'Images',
			'Joysticks',
			'Matieres',
			'Options',
			'Bornes',
			'BornesPerso',
			'BoutonsBornes',
			'Commandes',
			'ImagesArticlesBlog',
			'ImagesBornes',
			'JoysticksBornes',
			'OptionsBornes',
			'Paniers',
		];
		foreach ($seeders as $seeder) {
			try {
				$this->call("Seeder$seeder");
			} catch (InvalidArgumentException) {
				echo "Exception with 'Seeder$seeder.php' file", PHP_EOL;
				continue;
			}
		}
	}
	
}
