<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederThemes extends Seeder {
	
	public function run(): void {
		$this->db->table('theme')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO theme VALUES (?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, 'HunterxHunter'],
			[2, 'Marvel'],
			[3, 'Invincible'],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
