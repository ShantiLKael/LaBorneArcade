<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederBornesPerso extends Seeder {
	
	public function run(): void {
		$this->db->table('borneperso')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO borneperso VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, "Borne personnalisée de YYY", "Une borne d'arcade", 1600, date('d-m-Y H:i:s', time() - 86400), 2, 3, 1, 1],
			[2, "Borne personnalisée de ZZZ", "Une borne d'arcade", 1750, date('d-m-Y H:i:s', time() - 86400 * 2), 2, 3, 2, 3],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
