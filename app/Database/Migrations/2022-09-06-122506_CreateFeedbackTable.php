<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFeedbackTable extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
			'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'candidate_id'         => ['type' => 'int', 'constraint' => 11],
			'trainer_id'            => ['type' => 'int', 'constraint' => 11],
			'number'         => ['type' => 'int', 'constraint' => 30],
			'final_score'  	   => ['type' => 'decimal(14,2)', 'default'=>0.0],
			'status'      => ['type' => 'varchar', 'constraint' => 30, 'null' => true, 'default'=>'failed'], //comments passed, failed, on hold
			'reason'	           => ['type' => 'text',  'null' => true],
			'is_active'        => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
			'created_at'       => ['type' => 'datetime', 'null' => true],
			'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],

		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('feedbacks', true);

        $this->forge->addField([
			'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'feedback_id'     => ['type' => 'int', 'constraint' => 11],
			'trainer_id'       => ['type' => 'int', 'constraint' => 11],
			'number'         => ['type' => 'int', 'constraint' => 30],
			'weight'  	   => ['type' => 'decimal(2,2)', 'default'=>0.0],
			'created_at'       => ['type' => 'datetime', 'null' => true],
			'updated_at'       => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
        //$this->forge->addForeignKey('trainer_id', 'users', 'id', 'CASCADE', 'CASCADE');
        //$this->forge->addForeignKey('feedback_id', 'feedbacks', 'id', 'CASCADE', 'CASCADE');

		$this->forge->createTable('feedback_details', true);

    }

    public function down()
    {
        
        $this->forge->dropTable('feedbacks', true);
		$this->forge->dropTable('feedback_details', true);
    }
}
