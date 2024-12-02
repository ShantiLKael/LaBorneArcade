<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

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
			],
			'reponse'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"255",
				'null'      =>false,
			],
			'id_utilisateur'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_faq');
		$this->forge->addForeignKey('id_utilisateur','utilisateur','id_utilisateur');
		$this->forge->createTable('faq');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('faq', true);
	}
}
