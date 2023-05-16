<?php



// write a function to get tickets
function get_tickets(){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM tickets');
        $stmt->execute();
        $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    } catch(PDOException $e) {
        return -1;
    }
}

// write a function to get ticket by id
function get_ticket_by_id($id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM tickets WHERE id = ?');
        $stmt->execute(array($id));
        $ticket = $stmt->fetch(PDO::FETCH_ASSOC);
        return $ticket;
    } catch(PDOException $e) {
        return -1;
    }
}

function get_tickets_tracked_by_user(){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM tickets WHERE id IN (SELECT ticket_id FROM tracked_tickets WHERE user_id = ?)');
        $stmt->execute(array($_SESSION['user_id']));
        $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    } catch(PDOException $e) {
        return -1;
    }
}
//function to get ticket records
function get_ticket_records($ticket_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM ticket_records WHERE ticket_id = ?');
        $stmt->execute(array($ticket_id));
        $ticket_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ticket_records;
    } catch(PDOException $e) {
        return -1;
    }
}


?>