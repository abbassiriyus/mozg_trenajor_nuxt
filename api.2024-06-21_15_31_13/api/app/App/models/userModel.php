<?php 

namespace Wrql\App\models;

use Wrql\Core\Model;
use PDO;
use PDOException;

use Wrql\Helpers\JwtHandler;

class userModel extends Model
{

    public function settingsget()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM settings WHERE id = ?");
            $stmt->execute([1]);
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!isset($user[0])) {

                http_response_code(200);
                return [
                    "message" => "Ошибка",
                ];
            }else {
                http_response_code(200);
                return [
                    "message" => "Данные успешно получены.",
                    "data" => $user[0]
                ];
            }

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

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
                        'email' => $user[0]['email'],
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

    public function changeinfo($token) {
        try {
            $jwtHandler = new JwtHandler();

            $verify = $jwtHandler->verifyToken($token);
            $message = null;

            if($verify['status']) {
                $user_id = $verify['data']->user_id;

                if(isset($_POST['username']) || isset($_POST['email']) || isset($_POST['password'])) {


                    $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
                    $stmt->execute([$_POST['username'] ?? null, $_POST['email'] ?? null]);
                    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if(isset($user[0])) {
                        $message = "Вы пытаетесь ввести имя или почту, которые уже существуют";
                    }else{
                        if(isset($_POST['username']) && !empty($_POST['username'])) {
                            $stmt = $this->db->prepare("UPDATE users SET username = ? WHERE id = ?");                    
                            $stmt->execute([$_POST['username'], $user_id]);
                        }

                        if(isset($_POST['email']) && !empty($_POST['email'])) {
                            $stmt = $this->db->prepare("UPDATE users SET email = ? WHERE id = ?");                    
                            $stmt->execute([$_POST['email'], $user_id]);
                        }

                        if(isset($_POST['password'])) {
                            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                            $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");                    
                            $stmt->execute([$password, $user_id]);
                        }
                    }
                }

                if($message) {
                    http_response_code(400);
                    return [
                        "message" => $message,
                        "code" => 400
                    ];
                }

                http_response_code(200);
                return [
                    "message" => "Данные успешно обновлены.",
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

    public function getuserinfo($token) {
        try {
            $jwtHandler = new JwtHandler();

            $verify = $jwtHandler->verifyToken($token);

            if($verify['status']) {
                $user_id = $verify['data']->user_id;

                $stmt = $this->db->prepare("SELECT users.id, users.username, users.email, users.role FROM users WHERE users.id = ?");
                $stmt->execute([$user_id]);
                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt = $this->db->prepare("SELECT users.id, users.username, users.email, users.role, (SUM(training_results.true_clicks) * 100.0 / SUM(training_results.click_count)) AS 'prTrue',(SUM(training_results.false_clicks) * 100.0 / SUM(training_results.click_count)) AS 'preFalse',SUM(training_results.scores) AS 'scores', COUNT(training_results.id) AS 'countGames'FROM users JOIN training_results ON training_results.user_id = users.id WHERE users.id = ?");
                $stmt->execute([$user_id]);
                $user2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $ab = $this->db->prepare("SELECT training_results.id, training_results.training_id, training.difficulty, training_results.true_clicks, training_results.false_clicks, training_results.scores, training_results.date_end FROM users JOIN training_results ON training_results.user_id = users.id JOIN training ON training.id = training_results.training_id WHERE users.id = ?");
                $ab->execute([$user_id]);
                $stats = $ab->fetchAll(PDO::FETCH_ASSOC);

                http_response_code(200);
                return [
                    "message" => "Данные успешно получены.",
                    "dataProfile" => $user,
                    "dataProfileDop" => $user2,
                    "dataStats" => $stats,
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

    public function like($token) {
        try {
            $jwtHandler = new JwtHandler();

            $verify = $jwtHandler->verifyToken($token);

            if($verify['status']) {
                $user_id = $verify['data']->user_id;

                $stmt = $this->db->prepare("SELECT * FROM liked_games WHERE user_id = ? AND training_id = ?");
                $stmt->execute([$user_id, $_POST['id']]);
                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if(isset($user[0])) {
                    $stmt = $this->db->prepare("DELETE FROM liked_games WHERE user_id = ? AND training_id = ?;");
                    $stmt->execute([$user_id , $_POST['id']]);
                    
                    http_response_code(200);
                    return [
                        "message" => "Данные успешно обновлены.",
                        "status" => 1,
                        "code" => 200
                    ];
                }else {
                    $stmt = $this->db->prepare("INSERT INTO liked_games (user_id, training_id) VALUES (?, ?)");
                    $stmt->execute([$user_id, $_POST['id']]);

                    http_response_code(200);
                    return [
                        "message" => "НЕЕЕ",
                        "status" => 2,
                        "code" => 200
                    ];
                }

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
