<?php

use Illuminate\Database\Seeder;

class CareUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$conn1 = DB::connection('mysql_care');
    	$conn2 = DB::connection('mysql');
        $conn1->table('users')->orderBy('uid')->chunk(1000,function($users) use ($conn2){
            foreach ($users as $user){
            	if(!$conn2->table('users')->where('name',$user->user_id)->first()){
            		$userData = [
	                    'name' => $user->user_id,
	                    'password' => Hash::make('123456'),
	                    'created_at' => $user->reg_time,
	                    'updated_at' => $user->reg_time
	                ];
	                if(!empty($user->email))
	                	$userData['email'] = $user->email;
	                $result = $conn2->table('users')->insertGetId($userData);
	                $bussinessData = [
	                    'uid' => $result,
	                    'user_id' => $user->uid,
	                    'type' => 1
	                ];
	                $conn2->table('user_bussiness')->insert($bussinessData);
            	}
            }
        });
    }
}
