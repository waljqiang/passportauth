<?php
namespace App\Services;
use App\Repositories\UserRepository;

class UserService{
	private $userRepository;

	public function __construct(UserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

	public function synCareUser($params){
		$userID = array_get($params,'user_id');
		$name = array_get($params,'name');
		$email = array_get($params,'email',"");
		$password = config('open.user.defaultPassword');
		$email = array_get($params,'email');
		$type = array_get($params,'type',1);
		return $this->userRepository->registerUser($name,$password,$userID,$email,$type);
	}
}