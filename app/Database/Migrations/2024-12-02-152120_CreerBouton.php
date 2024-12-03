<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreerBouton extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_bouton'=>[
				'type'          =>"SERIAL",
				'unsigned'      =>true,
				'auto_increment'=>true,
			],
			'modele'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"50",
				'null'      =>false,
			],
			'forme'=>[
				'type'      =>"VARCHAR", // TODO: Ajouter contrainte check
				'constraint'=>"50",
				'null'      =>false,
			],
			'couleur'=>[
				'type'      =>"CHAR",
				'constraint'=>"6",
				'null'      =>false,
			],
			'eclairage'=>[
				'type'=>"BOOLEAN",
				'null'=>false,
			],
		]);
		$this->forge->addPrimaryKey('id_bouton');
		$this->forge->addUniqueKey('modele');
		$this->forge->addUniqueKey('couleur');
		$this->forge->addUniqueKey('eclairage');
		$this->forge->createTable('bouton');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('bouton', true);
	}
}
