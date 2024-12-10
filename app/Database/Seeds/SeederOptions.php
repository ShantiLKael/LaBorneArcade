<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederOptions extends Seeder {
	
	public function run(): void {
		$this->db->table('option')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO \"option\" VALUES (?, ?, ?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, "Sticker", "Borne sticker", 0, 1],
			[2, "Wood", "Borne wood", 0, 1],
			[3, "Wood gravée", "Borne wood gravée", 100, 1],
			[4, "Monnayeur", "Ajoutez un monnayeur pour le côté vintage ou pour faire payer vos amis ou vos clients ;) Choisissez la valeur de la pièce 1 euros, 50 centimes ou 20 centimes.", 100, 1],
			[5, "Spinner", "Le spinner vous permettra de jouer au jeu Arkanoid et à d'autres jeux de casse brique avec précision.", 100, 2],
			[6, "Carte Graphique", "Cette carte graphique vous permettra d'ajouter les systèmes Arcade Naomi, Atomiswave et Taito Type X.", 120, 3],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
