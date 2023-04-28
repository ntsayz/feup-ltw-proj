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
    $date = date("Y-m-d H:i:s");
    try {
  	  $stmt = $dbh->prepare('INSERT INTO faqs (question,answer,created_at)
       VALUES (:question,:answer,:created_at)');
  	  $stmt->bindParam(':question', $question);
        $stmt->bindParam(':answer', $answer);
        $stmt->bindParam(':created_at', $date);
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