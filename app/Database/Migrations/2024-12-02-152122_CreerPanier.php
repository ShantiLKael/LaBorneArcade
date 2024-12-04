<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreerPanier extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_utilisateur'=>[
				'type'    =>'INT',
				'unsigned'=>true,
				'null'    =>false,
			],
			'id_borne'=>[
				'type'    =>'INT',
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_utilisateur');
		$this->forge->addPrimaryKey('id_borne');
		$this->forge->addForeignKey('id_utilisateur','utilisateur','id_utilisateur', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_borne','borne','id_borne', 'CASCADE', 'CASCADE');
		$this->forge->createTable('panier');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('panier', true);
	}
}
