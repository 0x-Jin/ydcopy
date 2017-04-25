<?php


namespace App\Extensions;


use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Auth\GenericUser;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Curl;


class SqlsvrUserProvider implements UserProvider {

    protected $conn;


    public function __construct(ConnectionInterface $conn){
        $this->conn = $conn;
    }

    public function retrieveById($identifier){
        $sql = "SELECT id, code, salt, userPassword FROM users u left join UserSalt s on u.Code=s.UserCode where s.Id = '{$identifier}'";
        $user = head($this->conn->select($sql));
        return new GenericUser((array)$user);
    }

    public function retrieveByToken($identifier, $token){}

    public function updateRememberToken(UserContract $user, $token){}

    public function retrieveByCredentials(array $credentials){
        $sql = "SELECT id, code, salt, userPassword FROM users u left join UserSalt s on u.Code=s.UserCode where u.Code = '{$credentials['username']}'";
        $user = head($this->conn->select($sql));
        return new GenericUser((array)$user);
    }

    public function validateCredentials(UserContract $user, array $credentials) {
        if(isset($user->salt)){
            $url = "http://192.168.228.189:8080/makepwd.aspx";
            $res = Curl::to($url)->withData(['p'=>$credentials['password'], 's'=>$user->salt])->get();
            return $res == $user->userPassword;
        } else {
            return false;
        }
    }

    protected function getGenericUser($user){
        if ($user !== null) {
            return new GenericUser((array) $user);
        }
    }
}
