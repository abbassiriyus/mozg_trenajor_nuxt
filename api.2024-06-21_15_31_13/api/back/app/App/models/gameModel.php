<?php 

namespace Wrql\App\models;

use Wrql\Core\Model;
use PDO;
use PDOException;

use Wrql\Helpers\JwtHandler;

class gameModel extends Model
{
    public function getall()
    {
        try {

            $stmt = $this->db->prepare("SELECT * FROM training");
            $stmt->execute([]);
            $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

            http_response_code(200);
            return [
                "message" => "Данные успешно получены.",
                "data" => $games,
                "code" => 200
            ];

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getone($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM training WHERE id = ?");
            $stmt->execute([$id]);
            $game = $stmt->fetchAll(PDO::FETCH_ASSOC);

            http_response_code(200);
            return [
                "message" => "Данные успешно получены.",
                "data" => $game,
                "code" => 200
            ];

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function endgame($data)
    {
        try {
            if(isset($_POST['data']['user_token'])) {

                $jwtHandler = new JwtHandler();

                $verify = $jwtHandler->verifyToken($_POST['data']['user_token']);

                if($verify['status']) {

                    if(isset($_POST['data']['session_token'])) {
                        $v = $jwtHandler->verifyToken($_POST['data']['session_token']);

                        if($v['status']) {
                            $stmt = $this->db->prepare("SELECT * FROM sessionss WHERE token = ?;");
                            $stmt->execute([$_POST['data']['session_token']]);
                            $t = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            $stmt = $this->db->prepare("DELETE FROM sessionss WHERE id = ?;");
                            $stmt->execute([$t[0]['id']]);

                            date_default_timezone_set('Europe/Moscow');
                            $time = time();

                            $stmt = $this->db->prepare("INSERT INTO training_results (training_id, user_id, click_count, result_time, true_clicks, false_clicks, date_end) VALUES (?, ?, ?, ?, ?, ?, ?)");
                            $stmt->execute([$_POST['data']['training_id'], $verify['data']->user_id, $_POST['data']['click_count'], $_POST['data']['result_time'], $_POST['data']['true_clicks'], $_POST['data']['false_clicks'], $time]);
                            $game = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            http_response_code(200);
                            return [
                                "message" => "Данные успешно получены и записаны",
                                "data" => $game,
                                "code" => 200
                            ];
                        }else {
                            http_response_code(400);
                            return [
                                "message" => "Неверный токен сессии",
                                "code" => 400
                            ];
                        }

                    }else {
                        http_response_code(400);
                        return [
                            "message" => "Нет токена сессии",
                            "code" => 400
                        ];
                    }

                }else {
                    http_response_code(400);
                    return [
                        "message" => "Неверный токен.",
                        "code" => 400
                    ];
                }

            }else {
                http_response_code(200);
                return [
                    "message" => "Данные успешно получены.",
                    "code" => 200
                ];
            }

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function createsession($token)
    {
        try {
            if(isset($token)) {

                $jwtHandler = new JwtHandler();

                $verify = $jwtHandler->verifyToken($token);

                if($verify['status']) {

                    $userData = [
                        'user_id' => $verify['data']->user_id,
                        'exp' => time() + (1 * 60 * 60)
                    ];

                    $jwtHandler = new JwtHandler();
                    $token = $jwtHandler->generateToken($userData);
                    
                    $stmt = $this->db->prepare("INSERT INTO sessionss (token) VALUES (?)");
                    $stmt->execute([$token]);
                    $game = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    http_response_code(200);
                    return [
                        "message" => "Сессия создана.",
                        "data" => $token,
                        "code" => 200
                    ];

                }else {
                    http_response_code(400);
                    return [
                        "message" => "Неверный токен.",
                        "code" => 400
                    ];
                }

            }

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
