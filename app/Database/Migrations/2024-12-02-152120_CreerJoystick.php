<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
class CreerJoystick extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_joystick'=>[
				'type'          =>"SERIAL",
				'unsigned'      =>true,
				'auto_increment'=>true,
			],
			'modele'=>[
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
		$this->forge->addPrimaryKey('id_joystick');
		$this->forge->addUniqueKey('modele');
		$this->forge->addUniqueKey('couleur');
		$this->forge->createTable('joystick');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('joystick', true);
	}
}
