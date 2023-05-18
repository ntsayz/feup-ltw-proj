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

// function to submit a ticket using these args 'title','description', 'priority', $status_id, $user_id, 'department'
function submit_ticket($title, $description, $priority, $status_id, $user_id, $department){
    global $dbh;
    try {
        $stmt = $dbh->prepare('INSERT INTO tickets (title, description, priority, status_id, created_by, department_id) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title, $description, $priority, $status_id, $user_id, $department));
        return $dbh->lastInsertId();  // Return the last inserted ID
    } catch(PDOException $e) {
        return -1;
    }
}

//function to submit a ticket record using these args 'ticket_id', 'author_id', 'action'
function submit_ticket_record($ticket_id, $author_id, $action){
    global $dbh;
    try {
        $stmt = $dbh->prepare('INSERT INTO ticket_records (ticket_id, author_id, action) VALUES (?, ?, ?)');
        $stmt->execute(array($ticket_id, $author_id, $action));
        return $dbh->lastInsertId();  // Return the last inserted ID
    } catch(PDOException $e) {
        return -1;
    }
}

function get_tickets_tracked_by_user(){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM tickets WHERE id IN (SELECT ticket_id FROM tracked_tickets WHERE user_id = ?)');
        $stmt->execute(array($_SESSION['id']));
        $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    } catch(PDOException $e) {
        return -1;
    }
}

//function to get tickets that are being tracked and were submitted by a user
function get_tickets_tracked_and_submitted_by_user() {
    global $dbh;
    try {
        $stmt = $dbh->prepare('
            SELECT * FROM tickets
            WHERE id IN (SELECT ticket_id FROM ticket_tracking WHERE user_id = ?)
            UNION
            SELECT * FROM tickets
            WHERE created_by = ?
        ');
        $stmt->execute(array($_SESSION['id'], $_SESSION['id']));
        $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    } catch(PDOException $e) {
        return -1;
    }
}





?>