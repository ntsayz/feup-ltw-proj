<?php


  function check_login($username, $password) {
    global $dbh;
    $hashed_password = hash('sha256', $password);
    try {
      $stmt = $dbh->prepare('SELECT * FROM user WHERE username = ? AND Password = ?');
      $stmt->execute(array($username, $hashed_password));
      if($stmt->fetch() !== false) {
        return get_id($username);
      }
      else return -1;

    } catch(PDOException $e) {
      return -1;
    }
  }

  function get_id($username) {
    try {
        $stmt = $dbh->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute(array($username));
        if($row = $stmt->fetch()) {
            return $row['id'];
        }

    }catch(PDOException $e) {
        return -1;
    }

   }


?>