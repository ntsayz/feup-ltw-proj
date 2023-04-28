<?php

function get_faqs(){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM faqs');
        $stmt->execute();
        $faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $faqs;
    } catch(PDOException $e) {
        return -1;
    }
}

function submit_faq($question, $answer){
    global $dbh;
    try {
  	  $stmt = $dbh->prepare('INSERT INTO faqs ()
       VALUES ()');
  	  $stmt->bindParam(':username', $username);
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


?>