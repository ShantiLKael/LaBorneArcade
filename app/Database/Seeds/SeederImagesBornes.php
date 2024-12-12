<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

/**
 * @deprecated Utilisez <code>script_insertion.sql</code> à la place.
 */
class SeederImagesBornes extends Seeder {
	
	public function run(): void {
		$this->db->table('imageborne')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO imageborne VALUES (?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, 1],
			[1, 2],
			[2, 3],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
