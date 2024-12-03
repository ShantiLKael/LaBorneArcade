<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\Query;

class CreerBornePerso extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$prepared = $this->db->prepare(static function($db) {
			return (new Query($db))->setQuery("CREATE TABLE BornePerso (date_creation TIMESTAMP NOT NULL) INHERITS (Borne);");
		});
		$prepared->execute();
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('borneperso', true);
	}
}
