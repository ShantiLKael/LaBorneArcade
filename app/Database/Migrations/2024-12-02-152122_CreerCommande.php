<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
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
				'type'  =>"TIMESTAMP",
				'null'  =>false,
				'unique'=>false,
			],
			'date_modif'=>[
				'type'  =>"TIMESTAMP",
				'null'  =>false,
				'unique'=>false,
			],
			'etat'=>[
				'type'      =>"VARCHAR", // TODO: Ajouter une contrainte check
				'constraint'=>"50",
				'null'      =>false,
				'unique'    =>false,
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
		$this->forge->addForeignKey('id_borne','borne','id_borne', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_utilisateur','utilisateur','id_utilisateur', 'CASCADE', 'CASCADE');
		$this->forge->createTable('commande');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('commande', true);
	}
}
