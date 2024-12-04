<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Query;
use CodeIgniter\Database\Seeder;

class SeederUtilisateurs extends Seeder {
	
	public function run(): void {
		$this->db->table('utilisateur')->delete('1 = 1');
		
		$prepared = $this->db->prepare(static function($db) {
			$sql = "INSERT INTO utilisateur (id_utilisateur, email, mdp, role) VALUES (?, ?, ?, ?);";
			return (new Query($db))->setQuery($sql);
		});
		
		$data = [
			[1, "houhat@smallntm.lol", password_hash("houhat", PASSWORD_DEFAULT), "admin"],
			[2, "zadmiw@undeep.xyz", password_hash("dza552dza", PASSWORD_DEFAULT), "user"],
		];
		
		array_walk($data, function($d) use (&$prepared) {
			$prepared->execute(...$d);
		});
		
	}
	
}
