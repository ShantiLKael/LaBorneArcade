<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederMatieres extends Seeder {
	
	public function run(): void {
		$this->db->table('matiere')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO matiere VALUES (?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, 'Couleur 1', '78E97C'],
			[2, 'Couleur 2', '726E09'],
			[3, 'Couleur 3', '8402EA'],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
