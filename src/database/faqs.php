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


?>