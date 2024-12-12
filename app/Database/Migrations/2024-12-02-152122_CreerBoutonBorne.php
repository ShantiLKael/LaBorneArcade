<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
class CreerBoutonBorne extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_borne'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
			'id_bouton'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_borne');
		$this->forge->addPrimaryKey('id_bouton');
		$this->forge->addForeignKey('id_borne','borne','id_borne', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_bouton','bouton','id_bouton', 'CASCADE', 'CASCADE');
		$this->forge->createTable('boutonborne');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('boutonborne', true);
	}
}
