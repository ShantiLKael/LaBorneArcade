<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
class CreerFaq extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_faq'=>[
				'type'          =>"SERIAL",
				'unsigned'      =>true,
				'auto_increment'=>true,
			],
			'question'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"50",
				'null'      =>false,
				'unique'    =>false,
			],
			'reponse'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"255",
				'null'      =>false,
				'unique'    =>false,
			],
			'id_utilisateur'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_faq');
		$this->forge->addForeignKey('id_utilisateur','utilisateur','id_utilisateur', 'CASCADE', 'CASCADE');
		$this->forge->createTable('faq');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('faq', true);
	}
}
