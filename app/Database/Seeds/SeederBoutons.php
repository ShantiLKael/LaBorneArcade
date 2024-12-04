<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;
use Exception;

class SeederBoutons extends Seeder {
	
	/**
	 * @throws Exception
	 */
	public function run(): void {
		$this->db->table('bouton')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO bouton VALUES (?, ?, ?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$joysticks = [
			[1, 'Modèle 1', 'Carré',    '48C5F4', parse_bool_to_postgres(true)],
			[2, 'Modèle 2', 'Rond',     'C05D1B', parse_bool_to_postgres(true)],
			[3, 'Modèle 3', 'Triangle', 'D562E1', parse_bool_to_postgres(false)],
		];
		
		array_walk($joysticks, function($j) use (&$prepared) {
			$prepared->execute(...$j);
//			echo "Right", PHP_EOL;
		});
	}
	
}
