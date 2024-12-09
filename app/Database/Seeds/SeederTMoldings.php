<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederTMoldings extends Seeder {
	
	public function run(): void {
		$this->db->table('tmolding')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO tmolding VALUES (?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$tmoldings = [
			[1, 'Couleur 1', '186EF1'],
			[2, 'Couleur 2', 'E7CADF'],
			[3, 'Couleur 3', '2BDA08'],
		];
		
		array_walk($tmoldings, function($t) use (&$prepared) {
			$prepared->execute(...$t);
		});
	}
	
}
