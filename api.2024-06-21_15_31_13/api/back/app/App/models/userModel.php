<?php 

namespace Wrql\App\models;

use Wrql\Core\Model;
use PDO;
use PDOException;

use Wrql\Helpers\JwtHandler;

class userModel extends Model
{
    public function registration($email, $userUsername, $userPassword)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!isset($user[0])) {

                $password = password_hash($userPassword, PASSWORD_DEFAULT);

                $stmt = $this->db->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
                $stmt->execute([$email, $userUsername, $password]);
                
                http_response_code(200);
                return [
                    "message" => "Регистрация прошла успешно!",
                    "code" => 200
                ];
            }else {
                http_response_code(400);
                return [
                    "message" => "Пользователь с таким email уже существует.",
                    "code" => 400
                ];
            }

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function login($userUsername, $userPassword) {
        try {

            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$userUsername]);
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(isset($user[0])) {

                if (password_verify($userPassword, $user[0]['password'])) {

                    $userData = [
                        'user_id' => $user[0]['id'],
                        'username' => $user[0]['username'],
                        'exp' => time() + (24 * 60 * 60)
                    ];

                    $jwtHandler = new JwtHandler();
                    $token = $jwtHandler->generateToken($userData);
                    
                    http_response_code(200);
                    return [
                        "message" => "Авторизация прошла успешно!",
                        "token" => $token,
                        "code" => 200
                    ];

                } else {
                    http_response_code(400);
                    return [
                        "message" => "Пароль неверный!",
                        "code" => 400
                    ];
                }

            }else {
                http_response_code(400);
                return [
                    "message" => "Пользователя с таким email не существует.",
                    "code" => 400
                ];
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getuserinfo($token) {
        try {
            $jwtHandler = new JwtHandler();

            $verify = $jwtHandler->verifyToken($token);

            if($verify['status']) {
                $username = $verify['data']->username;

                $stmt = $this->db->prepare("SELECT id, username, role FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

                http_response_code(200);
                return [
                    "message" => "Данные успешно получены.",
                    "data" => $user,
                    "code" => 200
                ];

            }else {
                http_response_code(400);
                return [
                    "message" => "Неверный токен.",
                    "code" => 400
                ];
            }

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function checkAuth($token) {
        $jwtHandler = new JwtHandler();

        $verify = $jwtHandler->verifyToken($token);

        return $verify;
    }
}
