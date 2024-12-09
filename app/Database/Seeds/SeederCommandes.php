<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederCommandes extends Seeder {
	
	public function run(): void {
		$this->db->table('commande')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO commande VALUES (?, ?, ?, ?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, '03-12-2024 15:15:30', '03-12-2024 15:11:46', "Production", 1, 1],
			[2, '01-12-2024 12:47:18', '01-12-2024 12:47:18', "Envoyée", 2, 2],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
