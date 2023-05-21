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
function submit_ticket_record($ticket_id, $action, $author_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('INSERT INTO ticket_records (ticket_id, author_id, action) VALUES (?, ?, ?)');
        $stmt->execute(array($ticket_id, $author_id, $action));
        return $dbh->lastInsertId();  // Return the last inserted ID
    } catch(PDOException $e) {
        return -1;
    }
}

//function to update  ticket status using these args 'ticket_id', 'status_id'
function update_ticket_status($ticket_id, $status_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('UPDATE tickets SET status_id = ? WHERE id = ?');
        $stmt->execute(array($status_id, $ticket_id));
        return $dbh->lastInsertId();  // Return the last inserted ID
    } catch(PDOException $e) {
        return -1;
    }
}
//function to update  ticket priority using these args 'ticket_id', 'priority'
function update_ticket_priority($ticket_id, $priority){
    global $dbh;
    try {
        $stmt = $dbh->prepare('UPDATE tickets SET priority = ? WHERE id = ?');
        $stmt->execute(array($priority, $ticket_id));
        return $dbh->lastInsertId();  // Return the last inserted ID
    } catch(PDOException $e) {
        return -1;
    }
}

//function to update ticket assignee using these args 'ticket_id', 'assignee_id'
function update_ticket_assignee($ticket_id, $assignee_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('UPDATE tickets SET assigned_to = ? WHERE id = ?');
        $stmt->execute(array($assignee_id, $ticket_id));
        return $dbh->lastInsertId();  // Return the last inserted ID
    } catch(PDOException $e) {
        return -1;
    }
}

//function to update ticket department using these args 'ticket_id', 'department_id'
function update_ticket_department($ticket_id, $department_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('UPDATE tickets SET department_id = ? WHERE id = ?');
        $stmt->execute(array($department_id, $ticket_id));
        return $dbh->lastInsertId();  // Return the last inserted ID
    } catch(PDOException $e) {
        return -1;
    }
}



//function to get ticket submissions by user
function get_ticket_submissions_by_user($user_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM tickets WHERE created_by = ?');
        $stmt->execute(array($user_id));
        $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    } catch(PDOException $e) {
        return -1;
    }
}

//function to get tickets being tracked by a user
function get_tickets_tracked_by_user() {
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM ticket_tracking WHERE user_id = ?');
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

//function to submit to ticket tracking table
function submit_ticket_tracking($ticket_id, $user_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('INSERT INTO ticket_tracking (ticket_id, user_id) VALUES (?, ?)');
        $stmt->execute(array($ticket_id, $user_id));
        return $dbh->lastInsertId();  // Return the last inserted ID
    } catch(PDOException $e) {
        return -1;
    }
}

//function to remove from ticket tracking table
function remove_ticket_tracking($ticket_id, $user_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('DELETE FROM ticket_tracking WHERE ticket_id = ? AND user_id = ?');
        $stmt->execute(array($ticket_id, $user_id));
        return $stmt->rowCount();
    } catch(PDOException $e) {
        return -1;
    }
}

//function to get ticket records by author id
function get_ticket_records_by_author($author_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM ticket_records WHERE author_id = ?');
        $stmt->execute(array($author_id));
        $ticket_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ticket_records;
    } catch(PDOException $e) {
        return -1;
    }
}

function filter_tickets($status = null, $priority = null, $assignee = null, $department = null) {
    global $dbh;

    $query = "SELECT * FROM tickets WHERE 1=1";

    if ($status !== "NULL") {
        $query .= " AND status_id = :status";
    }

    if ($priority !== "NULL") {
        $query .= " AND priority = :priority";
    }

    if ($assignee !== "NULL") {
        $query .= " AND assigned_to = :assignee";
    }

    if ($department !== "NULL") {
        $query .= " AND department_id = :department";
    }

    $stmt =  $dbh->prepare($query);

    echo $query;

    if ($status !== "NULL") {
        $stmt->bindParam(':status', $status);
    }

    if ($priority !== "NULL") {
        $stmt->bindParam(':priority', $priority);
    }

    if ($assignee !== "NULL") {
        $stmt->bindParam(':assignee', $assignee);
    }

    if ($department !== "NULL") {
        $stmt->bindParam(':department', $department);
    }

    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}





?>