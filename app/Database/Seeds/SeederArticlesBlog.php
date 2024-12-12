<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

/**
 * @deprecated Utilisez <code>script_insertion.sql</code> à la place.
 */
class SeederArticlesBlog extends Seeder {
	
	public function run(): void {
		$this->db->table('articleblog')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO articleblog VALUES (?, ?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, "Article 1", "", 1],
			[2, "Article 2", "", 1],
			[3, "Article 3, alinéa 5", "", 2],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
