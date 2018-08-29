<?php
namespace App\Services;
use App\Repositories\UserRepository;
use Lcobucci\JWT\Parser;

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

	public function getUserByToken($bearerToken,$type){
        $jwt = trim(preg_replace('/^(?:\s+)?Bearer\s/', '', $bearerToken));
        $token = (new Parser())->parse($jwt);
        $clientID = $token->getClaim('aud');
        $user = $this->userRepository->getUserByClient($clientID,$type);
        $user->append('user_id');
        $user->append('client_id');
        if($user){
        	return [
	        	'user_id' => $user->user_id,
	        	'name' => $user->name,
	        	'email' => $user->email,
	        	'client_id' => $user->client_id,
	        	'oauth_user_id' => $user->id	
	        ];
        }else{
        	return false;
        }
	}
}