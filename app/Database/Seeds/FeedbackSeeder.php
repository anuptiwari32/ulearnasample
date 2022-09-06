<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class FeedbackSeeder extends Seeder
{
	public function run()
	{
		$data = [
			[
				'candidate_id'=>8,
				'trainer_id'=>2,
				'number'=>38,
				'final_score'=>7.71,
				'status'=>'failed',
				'reason'=>null,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),     
				'deleted_at'=>null ,
			],
			[
				'candidate_id'=>9,
				'trainer_id'=>2,
				'number'=>40,
				'final_score'=>8,
				'status'=>'failed',
				'reason'=>null,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),     
				'deleted_at'=>null ,
			]
		];
		$this->db->table('feedbacks')->insertBatch($data);
		
		//$this->db->query("INSERT INTO users (fullname, email,username,password,role,is_active,created_at,updated_at,deactivated_at) VALUES(:fullname:, :email:, :username:, :password:, :role:, :is_active:, :created_at:, :updated_at:, :deactivated_at:)", $data);

		$data = [
			[
				'feedback_id'=>1,
				'trainer_id'=>3,
				'number'=>8,
				'weight'=>0.5,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'feedback_id'=>1,
				'trainer_id'=>4,
				'number'=>6,
				'weight'=>0.4,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'feedback_id'=>1,
				'trainer_id'=>5,
				'number'=>9,
				'weight'=>0.6,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'feedback_id'=>1,
				'trainer_id'=>6,
				'number'=>7,
				'weight'=>0.7,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'feedback_id'=>1,
				'trainer_id'=>7,
				'number'=>8,
				'weight'=>0.9,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			], 
			[
				'feedback_id'=>2,
				'trainer_id'=>3,
				'number'=>9,
				'weight'=>0.5,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'feedback_id'=>2,
				'trainer_id'=>4,
				'number'=>7,
				'weight'=>0.4,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'feedback_id'=>2,
				'trainer_id'=>5,
				'number'=>9,
				'weight'=>0.6,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'feedback_id'=>2,
				'trainer_id'=>6,
				'number'=>7,
				'weight'=>0.7,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			],
			[
				'feedback_id'=>2,
				'trainer_id'=>7,
				'number'=>8,
				'weight'=>0.9,
				'created_at' => Time::now(),
				'updated_at' => Time::now()
			]
		];
		$this->db->table('feedback_details')->insertBatch($data);
	}
}
