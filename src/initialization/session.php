

<?php
    require_once(__DIR__.'/../database/user.php');
   session_start();

   function set_current_user($userID, $username) {
    	$_SESSION['username'] = $username;
    	$_SESSION['id'] = $userID;
        set_user_type($username);
   }

   function get_user_id() {
       if(isset($_SESSION['id'])) {
            return $_SESSION['id'];
       } else {
           return null;
       }

   }

   function set_user_type($username){
    $_SESSION['user_type'] = get_user_type($username);
   }

   function get_username() {
        if(isset($_SESSION['username'])) {
            return $_SESSION['username'];
        } else {
            return null;
        }

    }


    

    


?>