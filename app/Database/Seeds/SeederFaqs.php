<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederFaqs extends Seeder {
	
	public function run(): void {
		$this->db->table('faq')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO faq VALUES (?, ?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, "Question 1", "Réponse 1", 1],
			[2, "Question 2", "Réponse 2", 1],
			[3, "Question 3", "Réponse 3", 1],
			[4, "Question 4", "Réponse 4", 1],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
