<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
class CreerImageBorne extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_image'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
			'id_borne'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_image');
		$this->forge->addPrimaryKey('id_borne');
		$this->forge->addForeignKey('id_image','image','id_image', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_borne','borne','id_borne', 'CASCADE', 'CASCADE');
		$this->forge->createTable('imageborne');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('imageborne', true);
	}
}
