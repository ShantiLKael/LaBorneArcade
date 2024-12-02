<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreerImageArticleBlog extends Migration {
	
	/**
	 * @inheritDoc
	 */
	public function up(): void {
		$this->forge->addField([
			'id_articleblog'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
			'id_image'=>[
				'type'    =>"INT",
				'unsigned'=>true,
				'null'    =>false,
			],
		]);
		$this->forge->addPrimaryKey('id_articleblog');
		$this->forge->addPrimaryKey('id_image');
		$this->forge->addForeignKey('id_articleblog','articleblog','id_articleblog');
		$this->forge->addForeignKey('id_image','image','id_image');
		$this->forge->createTable('imagearticleblog');
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('imagearticleblog', true);
	}
}
