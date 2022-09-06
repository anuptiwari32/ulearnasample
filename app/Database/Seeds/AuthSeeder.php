<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AuthSeeder extends Seeder
{
	public function run()
	{
		$data = [
			[
				'fullname'    => "I'm Admin",
				'email'    => 'admin@admin.com',
				'username' => 'administrator',
				'password' => password_hash('admin123', PASSWORD_BCRYPT),
				'role' => 1,
				'is_active' => 1,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),
				'deactivated_at' => null,
			],
			[
				'fullname'    => "Trainer 1",
				'email'    => 'trainer1@gmail.com',
				'username' => 'trainer1',
				'password' => password_hash('123456', PASSWORD_BCRYPT),
				'role' => 3,
				'is_active' => 1,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),
				'deactivated_at' => null,
			],
			[
				'fullname'    => "Trainer 2",
				'email'    => 'trainer2@gmail.com',
				'username' => 'trainer2',
				'password' => password_hash('123456', PASSWORD_BCRYPT),
				'role' => 3,
				'is_active' => 1,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),
				'deactivated_at' => null,
			],
			[
				'fullname'    => "Trainer 3",
				'email'    => 'trainer3@admin.com',
				'username' => 'trainer3',
				'password' => password_hash('123456', PASSWORD_BCRYPT),
				'role' => 3,
				'is_active' => 1,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),
				'deactivated_at' => null,
			],
			[
				'fullname'    => "Trainer 4",
				'email'    => 'trainer4@gmail.com',
				'username' => 'trainer4',
				'password' => password_hash('123456', PASSWORD_BCRYPT),
				'role' => 3,
				'is_active' => 1,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),
				'deactivated_at' => null,
			],
			[
				'fullname'    => "Trainer 5",
				'email'    => 'trainer5@gmail.com',
				'username' => 'trainer5',
				'password' => password_hash('123456', PASSWORD_BCRYPT),
				'role' => 3,
				'is_active' => 1,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),
				'deactivated_at' => null,
			],
			[
				'fullname'    => "Trainer 6",
				'email'    => 'trainer6@gmail.com',
				'username' => 'trainer6',
				'password' => password_hash('123456', PASSWORD_BCRYPT),
				'role' => 3,
				'is_active' => 1,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),
				'deactivated_at' => null,
			],
			[
				'fullname'    => "Candidate 1",
				'email'    => 'candidate1@gmail.com',
				'username' => 'candidate1',
				'password' => password_hash('123456', PASSWORD_BCRYPT),
				'role' => 2,
				'is_active' => 1,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),
				'deactivated_at' => null,
			],
			[
				'fullname'    => "Candidate 2",
				'email'    => 'candidate2@gmail.com',
				'username' => 'candidate2',
				'password' => password_hash('123456', PASSWORD_BCRYPT),
				'role' => 2,
				'is_active' => 1,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),
				'deactivated_at' => null,
			]
		];
		$this->db->table('users')->insertBatch($data);
		
		//$this->db->query("INSERT INTO users (fullname, email,username,password,role,is_active,created_at,updated_at,deactivated_at) VALUES(:fullname:, :email:, :username:, :password:, :role:, :is_active:, :created_at:, :updated_at:, :deactivated_at:)", $data);

		$data = [
			[
				'name' => 'administrator',
			], [
				'name' => 'user'
			],
			[
				'name' => 'trainer'
			]
		];
		$this->db->table('auth_roles')->insertBatch($data);
	}
}
