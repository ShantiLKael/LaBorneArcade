<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreerArticleBlog extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_articleblog'=>[
				'type'          =>"SERIAL",
				'unsigned'      =>true,
				'auto_increment'=>true,
			],
			'titre'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"50",
				'null'      =>false,
			],
			'texte'=>[
				'type'=>"TEXT",
				'null'=>false,
			],
			'id_utilisateur'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_articleblog');
		$this->forge->addForeignKey('id_utilisateur','utilisateurs','id_utilisateur');
		$this->forge->createTable('articleblog');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('articleblog', true);
	}
}
