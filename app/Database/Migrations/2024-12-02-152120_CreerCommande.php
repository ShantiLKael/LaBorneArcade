<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreerCommande extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_commande'=>[
				'type'          =>"SERIAL",
				'unsigned'      =>true,
				'auto_increment'=>true,
			],
			'date_creation'=>[
				'type'=>"TIMESTAMP",
				'null'=>false,
			],
			'date_modif'=>[
				'type'=>"TIMESTAMP",
				'null'=>false,
			],
			'etat'=>[
				'type'      =>"VARCHAR", // TODO: Ajouter une contrainte check
				'constraint'=>"50",
				'null'      =>false,
			],
			'id_borne'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
			'id_utilisateur'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_commande');
		$this->forge->addForeignKey('id_borne','borne','id_borne');
		$this->forge->addForeignKey('id_utilisateur','utilisateurs','id_utilisateur');
		$this->forge->createTable('commande');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('commande', true);
	}
}
