<?php /** @noinspection SqlResolve */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\Query;

/**
 * @deprecated Utilisez <code>script_creation.sql</code> à la place.
 */
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
				'unique'    =>false,
			],
			'forme'=>[
				'type'      =>"VARCHAR",
				'constraint'=>"50",
				'null'      =>false,
				'unique'    =>false,
			],
			'couleur'=>[
				'type'      =>"CHAR",
				'constraint'=>"6",
				'null'      =>false,
				'unique'    =>false,
			],
			'eclairage'=>[
				'type'  =>"BOOLEAN",
				'null'  =>false,
				'unique'=>false,
			],
		]);
		$this->forge->addPrimaryKey('id_bouton');
		$this->forge->createTable('bouton');
		
		$prepare = $this->db->prepare(static function($db) {
			$sql = "ALTER TABLE bouton ADD CONSTRAINT unique_bouton UNIQUE (modele, couleur, eclairage);";
			return (new Query($db))->setQuery($sql);
		});
		$prepare->execute();
	}
	
	/**
	 * @inheritDoc
	 */
	public function down(): void {
		$this->forge->dropTable('bouton', true);
	}
}
