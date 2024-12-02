<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

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
		$this->forge->addForeignKey('id_borne','borne','id_borne');
		$this->forge->addForeignKey('id_joystick','joystick','id_joystick');
		$this->forge->createTable('joystickborne');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('joystickborne', true);
	}
}
