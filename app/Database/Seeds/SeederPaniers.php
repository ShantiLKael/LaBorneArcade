<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederPaniers extends Seeder {
	
	public function run(): void {
		$this->db->table('panier')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO panier VALUES (?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, 2],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
