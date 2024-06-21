<?php 

namespace Wrql\App\models;

use Wrql\Core\Model;
use PDO;
use PDOException;

use Wrql\Helpers\JwtHandler;

class gameModel extends Model
{ 

    public function getliked($token = null)
    {
        try {

            $jwtHandler = new JwtHandler();

            if(isset($token)) {
                $verify = $jwtHandler->verifyToken($token);

                if($verify['status']) {
                    $user_id = $verify['data']->user_id;

                    $stmt = $this->db->prepare("SELECT * FROM training JOIN liked_games ON training.id = liked_games.training_id WHERE liked_games.user_id = ?");
                    $stmt->execute([$user_id]);
                    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    http_response_code(200);
                    return [
                        "message" => "Данные успешно получены.",
                        "data" => $games,
                        "code" => 200
                    ];
                }
            }

            http_response_code(200);
            return [
                "message" => "Данные успешно получены.",
                "data" => null,
                "code" => 200
            ];

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getall($token = null)
    {
        try {

            $stmt = $this->db->prepare("SELECT * FROM training");
            $stmt->execute([]);
            $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $jwtHandler = new JwtHandler();

            if(isset($token)) {
                $verify = $jwtHandler->verifyToken($token);

                if($verify['status']) {
                    $user_id = $verify['data']->user_id;

                    $stmt = $this->db->prepare("SELECT * FROM liked_games WHERE user_id = ?");
                    $stmt->execute([$user_id]);
                    $tokenmsg = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    http_response_code(200);
                    return [
                        "message" => "Данные успешно получены.",
                        "data" => $games,
                        "upd" => $tokenmsg,
                        "code" => 200
                    ];
                }
            }

            http_response_code(200);
            return [
                "message" => "Данные успешно получены.",
                "data" => $games,
                "upd" => null,
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

                            $clickCoefficient = 1;
                            $correctClickCoefficient = 5;
                            $incorrectClickCoefficient = -2;
    
                            $clickScore = $_POST['data']['click_count'] * $clickCoefficient;
                            $correctClickScore = $_POST['data']['true_clicks'] * $correctClickCoefficient;
                            $incorrectClickScore = $_POST['data']['false_clicks'] * $incorrectClickCoefficient;
                            
                            $totalScore = $clickScore + $correctClickScore + $incorrectClickScore;

                            if($totalScore < 0) $totalScore = 0;

                            $stmt = $this->db->prepare("INSERT INTO training_results (training_id, user_id, click_count, result_time, true_clicks, false_clicks, date_end, scores) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->execute([$_POST['data']['training_id'], $verify['data']->user_id, $_POST['data']['click_count'], $_POST['data']['result_time'], $_POST['data']['true_clicks'], $_POST['data']['false_clicks'], $time, $totalScore]);
                            $game = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            http_response_code(200);
                            return [
                                "message" => "Данные успешно получены и записаны",
                                "data" => $game,
                                $clickScore,
                                $correctClickScore,
                                $incorrectClickScore,
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

                    $stmt = $this->db->prepare("SELECT * FROM sessionss WHERE user_id = ?;");
                    $stmt->execute([$verify['data']->user_id]);
                    $t = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if(isset($t[0]['token'])) {
                        $stmt = $this->db->prepare("DELETE FROM sessionss WHERE user_id = ?;");
                        $stmt->execute([$verify['data']->user_id]);
                    }
                    $stmt = $this->db->prepare("INSERT INTO sessionss (token, user_id) VALUES (?, ?)");
                    $stmt->execute([$token, $verify['data']->user_id]);

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

    public function getstats($gameId) {
        try {
            $stmt = $this->db->prepare("SELECT training_results.id, training_results.click_count, training_results.result_time, training_results.true_clicks, training_results.false_clicks, training_results.scores, training_results.date_end, users.username FROM training_results JOIN users ON training_results.user_id = users.id WHERE training_id = ? ORDER BY training_results.scores DESC LIMIT 10;");
            $stmt->execute([$gameId]);
            $t = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(isset($t[0]['id'])) {
                http_response_code(200);
                return [
                    "data" => $t,
                    "code" => 200
                ];
            }else {
                http_response_code(200);
                return [
                    "data" => null,
                    "code" => 200
                ];
            }


        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getallstats($token) {
        try {
            if(isset($token)) {

                $jwtHandler = new JwtHandler();

                $verify = $jwtHandler->verifyToken($token);

                if($verify['status']) {

                    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?;");
                    $stmt->execute([$verify['data']->user_id]);
                    $t = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if($t[0]['role'] == 2) {
                        $stmt = $this->db->prepare("SELECT training.type, training.title, COUNT(training_results.id) AS count, AVG(training_results.scores) AS avg FROM training_results JOIN training ON training_results.training_id = training.id GROUP BY training.type, training.title;");
                        $stmt->execute([]);
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        $stmt = $this->db->prepare("SELECT training.type, COUNT(training_results.id) AS count, AVG(training_results.scores) AS avg_scores FROM training_results JOIN training ON training_results.training_id = training.id GROUP BY training.type;");
                        $stmt->execute([]);
                        $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        http_response_code(200);
                        return [
                            "message" => "Данные успешно получены.",
                            "data" => $data,
                            "data1" => $data1,
                            "code" => 200
                        ];
                    }

                    http_response_code(200);
                    return [
                        "message" => "Вы не являетесь администратором, чтобы просматривать данный раздел.",
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
