<?php

class Reminder {

    public function __construct() {

    }

    public function get_all_reminders ($user_id) {
      $db = db_connect();
      $statement = $db->prepare("select id, subject, created_at, completed from notes where user_id = :user_id and deleted = 0 order by created_at desc");
      $statement->execute([':user_id' => $user_id]);
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function update_reminder($id, $subject) {
      $db = db_connect();
      // do update statement
      $statement = $db->prepare("update notes set subject = :subject where id = :id");
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->bindParam(':subject', $subject, PDO::PARAM_STR);
      return $statement->execute();
    }

    public function completion($id) {
      $db = db_connect();
      $statement = $db->prepare("update notes set completed = not completed where id = :id");
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->execute();
      $rows = $statement->rowCount();
      return $rows;
    }

    public function create_reminder ($user_id, $subject) {
      $user_id = $_SESSION['user_id'];
      $db = db_connect();
      $statement = $db->prepare("insert into notes (user_id, subject, created_at) values (:user_id, :subject, NOW())");
      $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $statement->bindParam(':subject', $subject, PDO::PARAM_STR);
      $statement->execute();
      $rows = $statement->rowCount();
      return $rows;
    }
  
    public function delete_reminder($id) {
      $db = db_connect();
      $statement = $db->prepare("update notes set deleted = 1 where id = :id");
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->execute();
      $rows = $statement->rowCount();
      return $rows;
    }

    public function get_specific_reminder($id) {
      $db = db_connect();
      $statement = $db->prepare("select * from notes where id = :id and deleted = 0");
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
}
  ?>