<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederImages extends Seeder {
	
	public function run(): void {
		$this->db->table('image')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO image VALUES (?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, '/image1.png'],
			[2, '/image2.png'],
			[3, '/image3.png'],
			[4, '/image3.png'],
			[5, '/image3.png'],
			[6, '/image3.png'],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
