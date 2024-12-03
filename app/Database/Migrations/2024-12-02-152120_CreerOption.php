<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreerOption extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_option'=>[
				'type'           =>"SERIAL",
				'unsigned'       =>true,
				'auto_increment' =>true,
			],
			'nom'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"50",
				'unique'    =>true,
				'null'      =>false,
			],
			'description'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"255",
				'null'      =>false,
			],
			'cout'=>[
				'type'=>"INT",
				'null'=>false,
			],
			'id_image'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_option');
		$this->forge->addForeignKey('id_image','image','id_image');
		$this->forge->createTable('option');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('option', true);
	}
}
