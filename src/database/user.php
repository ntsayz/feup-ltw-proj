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

  //function to get user full name
  function get_full_name($id) {
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT full_name FROM users WHERE id = ?');
        $stmt->execute(array($id));
        if($row = $stmt->fetch()) {
            return $row['full_name'];
        }

    }catch(PDOException $e) {
        return -1;
    }

  }

  //function to get username by id
  function get_username_by_id($id) {
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT username FROM users WHERE id = ?');
        $stmt->execute(array($id));
        if($row = $stmt->fetch()) {
            return $row['username'];
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

  //function to get user type by id
  function get_user_type_by_id($id){
    global $dbh;
    try {
      $stmt = $dbh->prepare('SELECT user_type FROM users WHERE id = ?');
      $stmt->execute(array($id));
      if($row = $stmt->fetch()) {
        return $row['user_type'];
    }
  	  
    }catch(PDOException $e) {
      
      return "error getting user type";
    }
        
  }

  // function to change user username
  function change_username($username, $new_username){
    global $dbh;
    try {
      $stmt = $dbh->prepare('UPDATE users SET username = ? WHERE username = ?');
      $stmt->execute(array($new_username, $username));
      return 0;
    } catch(PDOException $e) {
      return -1;
    }
  }

  // function to change user password
  function change_password($username, $new_password){
    global $dbh;
    $hashed_password = hash('sha256', $new_password);
    try {
      $stmt = $dbh->prepare('UPDATE users SET password = ? WHERE username = ?');
      $stmt->execute(array($hashed_password, $username));
      return 0;
    } catch(PDOException $e) {
      return -1;
    }
  }

   // function to change user email
   function change_email($username, $new_email){
    global $dbh;
    try {
      $stmt = $dbh->prepare('UPDATE users SET email = ? WHERE username = ?');
      $stmt->execute(array($new_username, $new_email));
      return 0;
    } catch(PDOException $e) {
      return -1;
    }
  }


//function to get users with a certain type
function get_users_by_type($type){
  global $dbh;
  try {
    $stmt = $dbh->prepare('SELECT * FROM users WHERE user_type = ?');
    $stmt->execute(array($type));
    return $stmt->fetchAll();
  } catch(PDOException $e) {
    return -1;
  }
}

  


?>