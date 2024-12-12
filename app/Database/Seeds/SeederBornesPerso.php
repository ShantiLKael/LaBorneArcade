<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

/**
 * @deprecated Utilisez <code>script_insertion.sql</code> à la place.
 */
class SeederBornesPerso extends Seeder {
	
	public function run(): void {
		$this->db->table('borneperso')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO borneperso VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, "Borne personnalisée de YYY", "Une borne d'arcade", 1600, date('d-m-Y H:i:s', 1733751664), date('d-m-Y H:i:s', 1733751664), 2, 3, 1],
			[2, "Borne personnalisée de ZZZ", "Une borne d'arcade", 1750, date('d-m-Y H:i:s', 1733751664), date('d-m-Y H:i:s', 1733751664), 2, 3, 3],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
