<?php
//function to get messages
function get_messages($ticket_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM messages WHERE ticket_id = ?');
        $stmt->execute(array($ticket_id));
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    } catch(PDOException $e) {
        return -1;
    }
}


?>