<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\Query;

class CreerBornePerso extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_borneperso'=>[
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
			'date_creation'=>[
				'type'=>"TIMESTAMP",
				'null'=>false,
			],
			'date_modif'=>[
				'type'=>"TIMESTAMP",
				'null'=>false,
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
		$this->forge->addPrimaryKey('id_borneperso');
		$this->forge->addForeignKey('id_tmolding','tmolding','id_tmolding', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_matiere','matiere','id_matiere', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_theme','theme','id_theme', 'CASCADE', 'CASCADE');
		$this->forge->createTable('borneperso');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('borneperso', true, true);
	}
}
