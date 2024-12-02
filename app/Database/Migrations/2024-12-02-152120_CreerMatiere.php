<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreerMatiere extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_matiere'=>[
				'type'          =>"SERIAL",
				'unsigned'      =>true,
				'auto_increment'=>true,
			],
			'nom'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"50",
				'null'      =>false,
			],
			'couleur'=>[
				'type'      =>"CHAR",
				'constraint'=>"6",
				'null'      =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_matiere');
		$this->forge->addUniqueKey('nom');
		$this->forge->addUniqueKey('couleur');
		$this->forge->createTable('matiere');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('matiere', true);
	}
}
