<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
class CreerBorne extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_borne'=>[
				'type'          =>"SERIAL",
				'unsigned'      =>true,
				'auto_increment'=>true,
			],
			'nom'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"50",
				'null'      =>false,
				'unique'    =>false,
			],
			'description'=>[
				'type'  =>"TEXT",
				'null'  =>false,
				'unique'=>false,
			],
			'prix'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
				'unique'  =>false,
			],
			'id_tmolding'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
			'id_matiere'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
			'id_theme'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_borne');
		$this->forge->addForeignKey('id_tmolding','tmolding','id_tmolding', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_matiere','matiere','id_matiere', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_theme','theme','id_theme', 'CASCADE', 'CASCADE');
		$this->forge->createTable('borne');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('borne', true, true);
	}
}
