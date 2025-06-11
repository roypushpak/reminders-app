<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        // Constructor can be empty or used for initialization if needed
    }

    public function test() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users LIMIT 1");
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create_user($username, $password) {
        $db = db_connect();
        // Hash the password
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        // Use parameterized query to prevent SQL injection
        $statement = $db->prepare("INSERT INTO users (username, password_hash, is_admin) VALUES (:username, :password_hash, false) RETURNING id");
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password_hash', $hash, PDO::PARAM_STR);
        $statement->execute();
        
        return $db->lastInsertId();
    }
    public function usernameExists($username) {
        $db = db_connect();
        $statement = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }
    public function attemptLog($username, $attempt) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO log (username, attempt) VALUES (:username, :attempt::attempt_status)");
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->bindValue(':attempt', $attempt, PDO::PARAM_STR);
        return $statement->execute();
    }
    public function locked($username) {
        $db = db_connect();
        $sixtySeconds = date('Y-m-d H:i:s', time() - 60);
        $statement = $db->prepare("SELECT COUNT(*) FROM log WHERE username = :username AND attempt = 'bad'::attempt_status AND time >= :sixtySeconds");
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->bindValue(':sixtySeconds', $sixtySeconds, PDO::PARAM_STR);
        $statement->execute();
        $badAttempts = $statement->fetchColumn();
        return $badAttempts >= 3;
    }
    public function authenticate($username, $password) {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            return false;
        }

        $username = strtolower(trim($username));
        
        // Check if account is locked
        if ($this->locked($username)) {
            $_SESSION['locked_text'] = "Account is locked for 60 seconds.";
            return false;
        }

        // Get user data
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Successful login
            $this->attemptLog($username, 'good');
            $_SESSION['auth'] = true;
            $_SESSION['username'] = ucwords($username);
            $_SESSION['user_id'] = $user['id'];
            unset($_SESSION['failedAuth']);
            header('Location: /home');
            exit();
        } else {
            // Failed login
            $this->attemptLog($username, 'bad');
            $_SESSION['failedAuth'] = ($_SESSION['failedAuth'] ?? 0) + 1;
            header('Location: /login');
            exit();
        }
    }
    public function getUserId($username) {
        $db = db_connect();
        $statement = $db->prepare("SELECT id FROM users WHERE username = :username");
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;
    }
}