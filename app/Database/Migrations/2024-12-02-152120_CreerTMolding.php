<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
class CreerTMolding extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_tmolding'=>[
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
		$this->forge->addPrimaryKey('id_tmolding');
		$this->forge->addUniqueKey('nom');
		$this->forge->addUniqueKey('couleur');
		$this->forge->createTable('tmolding');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('tmolding', true);
	}
}
