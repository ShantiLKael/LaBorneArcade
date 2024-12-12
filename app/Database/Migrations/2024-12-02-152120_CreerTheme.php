<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
class CreerTheme extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_theme'=>[
				'type'          =>"SERIAL",
				'unsigned'      =>true,
				'auto_increment'=>true,
			],
			'nom'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"50",
				'unique'    =>true,
				'null'      =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_theme');
		$this->forge->createTable('theme');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('theme', true);
	}
}
