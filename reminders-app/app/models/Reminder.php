<?php

class Reminder {
    public function __construct() {
        // Constructor can be empty or used for initialization if needed
    }

    public function get_all_reminders($user_id) {
        $db = db_connect();
        $statement = $db->prepare("SELECT id, subject, created_at, completed FROM notes WHERE user_id = :user_id AND deleted = false ORDER BY created_at DESC");
        $statement->execute([':user_id' => $user_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_specific_reminder($id) {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM notes WHERE id = :id AND deleted = false");
        $statement->execute([':id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create_reminder($user_id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO notes (user_id, subject, completed, deleted) VALUES (:user_id, :subject, false, false) RETURNING id");
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':subject', $subject, PDO::PARAM_STR);
        $statement->execute();
        return $db->lastInsertId();
    }

    public function update_reminder($id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE notes SET subject = :subject WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':subject', $subject, PDO::PARAM_STR);
        $statement->execute();
        return $statement->rowCount();
    }

    public function delete_reminder($id) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE notes SET deleted = true WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->rowCount();
    }

    public function toggle_complete($id, $completed) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE notes SET completed = :completed WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':completed', $completed, PDO::PARAM_BOOL);
        $statement->execute();
        return $statement->rowCount();
    }

    public function completion($id) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE notes SET completed = NOT completed WHERE id = :id RETURNING completed");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['completed'] : false;
    }
}
?>