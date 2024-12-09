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
			[3, "Borne D'arcade Aliens", "Une borne d'arcade", 1490, 3, 1, 1, 1],
			[4, "Borne D'arcade Starship Troopers", "Une borne d'arcade", 1490, 3, 1, 1, 1],
			[5, "Borne D'arcade Barbie", "Une borne d'arcade", 1490, 3, 1, 1, 1],
			[6, "Borne D'arcade Terminator", "Une borne d'arcade", 1490, 3, 1, 1, 1],
			[7, "Borne D'arcade Pacman", "Une borne d'arcade", 1490, 3, 1, 1, 1],
			[8, "Borne D'arcade Niancat", "Une borne d'arcade", 1490, 3, 1, 1, 1],
			[9, "Borne D'arcade CodeIgniter", "Une borne d'arcade", 1490, 3, 1, 1, 1],
			[10, "Borne D'arcade Toy Story", "Une borne d'arcade", 1490, 3, 1, 1, 1],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
