<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
class CreerImage extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_image'=>[
				'type'          =>"SERIAL",
				'unsigned'      =>true,
				'auto_increment'=>true,
			],
			'chemin'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"255",
				'null'      =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_image');
		$this->forge->createTable('image');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('image', true);
	}
}
