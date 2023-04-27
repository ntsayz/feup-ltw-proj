<?php


  function check_login($username, $password) {
    global $dbh;
    $hashed_password = hash('sha256', $password);
    try {
      $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
      $stmt->execute(array($username, $hashed_password));
      if($stmt->fetch() !== false) {
        return get_id($username);
      }
      else return -1;

    } catch(PDOException $e) {
      return -5;
    }
  }

  function get_id($username) {
    global $dbh;
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



   function username_exists($username) {
    global $dbh;
    try {
      $stmt = $dbh->prepare('SELECT id FROM users WHERE username = ?');
      $stmt->execute(array($username));
      return $stmt->fetch()  !== false;
    
    }catch(PDOException $e) {
      return true;
    }
  }

  function email_exists($email) {
    global $dbh;
    try {
      $stmt = $dbh->prepare('SELECT id FROM users WHERE email = ?');
      $stmt->execute(array($email));
      return $stmt->fetch()  !== false;
    
    }catch(PDOException $e) {
      return true;
    }
  }

  function create_user($username, $password, $full_name, $email, $ref_code) {
    $user_type = "client";
    if($ref_code == "FOREVER258"){
      $user_type = "admin";
    }
    $hashed_password = hash('sha256', $password);
    global $dbh;
    try {
  	  $stmt = $dbh->prepare('INSERT INTO users (username, password, full_name, email, user_type)
       VALUES (:username,:password ,:full_name,:email,:user_type)');
  	  $stmt->bindParam(':username', $username);
  	  $stmt->bindParam(':password', $hashed_password);
  	  $stmt->bindParam(':full_name', $full_name);
  	  $stmt->bindParam(':email', $email);
      $stmt->bindParam(':user_type', $user_type);
      if($stmt->execute()){
        $id = get_id($username);
        return $id;
      }
      else
        return -1;
    }catch(PDOException $e) {
      
      return -1;
    }
    
  }


  function get_user_type($username){
    global $dbh;
    try {
      $stmt = $dbh->prepare('SELECT user_type FROM users WHERE username = ?');
      $stmt->execute(array($username));
      if($row = $stmt->fetch()) {
        return $row['user_type'];
    }
  	  
    }catch(PDOException $e) {
      
      return "error getting user type";
    }
        
  }


?>