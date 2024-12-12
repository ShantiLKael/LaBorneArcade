<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
class CreerUtilisateur extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_utilisateur'=>[
				'type'          =>"SERIAL",
				'unsigned'      =>true,
				'auto_increment'=>true,
			],
			'email'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"255",
				'unique'    =>true,
				'null'      =>false,
			],
			'mdp'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"255",
				'null'      =>false,
			],
			'role'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"50",
				'null'      =>false,
			],
			'token_mdp'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"255",
				'unique'    =>true,
				'null'      =>true,
			],
			'creation_token_mdp'=>[
				'type'=>"TIMESTAMP",
				'null'=>true,
			],
		]);
		$this->forge->addPrimaryKey('id_utilisateur');
		$this->forge->createTable('utilisateur');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('utilisateur', true);
	}
}
