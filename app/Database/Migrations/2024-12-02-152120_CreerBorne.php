<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

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
			],
			'description'=>[
				'type'=>"TEXT",
				'null'=>false,
			],
			'prix'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
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
			'id_image'=>[
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
		$this->forge->addForeignKey('id_image','image','id_image', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_theme','theme','id_theme', 'CASCADE', 'CASCADE');
		$this->forge->createTable('borne');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('borne', true);
	}
}
