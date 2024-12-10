<?php

/** @noinspection SqlResolve */

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederJoysticksBornes extends Seeder {
	
	public function run(): void {
		$this->db->table('joystickborne')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO joystickborne VALUES (?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, 3],
			[2, 2],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
	}
	
}
