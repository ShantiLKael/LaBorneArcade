<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

/**
 * @deprecated Utilisez <code>script_insertion.sql</code> à la place.
 */
class SeederImageBorne extends Seeder {
	
	public function run(): void {
		$this->db->table('imageborne')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO imageborne VALUES (?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, 1],
			[2, 2],
			[3, 3],
			[4, 4],
			[5, 5],
			[6, 6],
			[1, 7],
			[2, 8],
			[3, 9],
			[4, 10],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
