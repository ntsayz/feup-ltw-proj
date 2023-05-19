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
//function to submit messages
function submit_message($ticket_id, $user_id, $message){
    global $dbh;
    try {
        $stmt = $dbh->prepare('INSERT INTO messages (ticket_id, user_id, message) VALUES (?, ?, ?)');
        $stmt->execute(array($ticket_id, $user_id, $message));
        return $dbh->lastInsertId();  // Return the last inserted ID
    } catch(PDOException $e) {
        return -1;
    }
}


?>