<?php

    function change_user_type($username,$type){
        global $dbh;
        try {
            $stmt = $dbh->prepare('UPDATE users SET user_type=:user_type WHERE username=:username)');
            $stmt->bindParam(':user_type', $type);
            $stmt->bindParam(':username', $username);
          if($stmt->execute()){
            return 0;
          }
          else{
            return -1;
          }
            
        }catch(PDOException $e) {
          return -1;
        }
    }

    function get_all_users(){
        global $dbh;
        try {
            $stmt = $dbh->prepare('SELECT * FROM users');
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch(PDOException $e) {
            return -1;
        }
    }

    function delete_user($username, $userID){
        global $dbh;
        try {
            $stmt = $dbh->prepare('DELETE FROM users WHERE username=:username OR id=:userID');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':userID', $userID);
          if($stmt->execute()){
            return 0;
          }
          else{
            return -1;
          }
            
        }catch(PDOException $e) {
          return -1;
        }

    }

?>