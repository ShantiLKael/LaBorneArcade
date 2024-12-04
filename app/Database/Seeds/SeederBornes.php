<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederBornes extends Seeder {
	
	public function run(): void {
		$this->db->table('borne')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO borne VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, "Borne D'arcade Galaktronik", "Une borne d'arcade", 1490, 1, 2, 1, 3],
			[2, "Borne D'arcade Ken le survivant", "Une borne d'arcade", 1490, 3, 1, 1, 1],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
