<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
class CreerJoystickBorne extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_borne'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
			'id_joystick'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_borne');
		$this->forge->addPrimaryKey('id_joystick');
		$this->forge->addForeignKey('id_borne','borne','id_borne', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_joystick','joystick','id_joystick', 'CASCADE', 'CASCADE');
		$this->forge->createTable('joystickborne');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('joystickborne', true);
	}
}
