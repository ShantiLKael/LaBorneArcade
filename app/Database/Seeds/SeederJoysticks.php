<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederJoysticks extends Seeder {
	
	public function run(): void {
		$this->db->table('joystick')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO joystick VALUES (?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, 'Couleur 1', 'F35404'],
			[2, 'Couleur 2', '5C95A0'],
			[3, 'Couleur 3', '4211B4'],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
