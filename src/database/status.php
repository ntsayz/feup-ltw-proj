<?php
//function to get statuses
function get_statuses(){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM status');
        $stmt->execute();
        $statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $statuses;
    } catch(PDOException $e) {
        return -1;
    }
}

//function to get status name by id
function get_status_name_by_id($id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT name FROM status WHERE id = ?');
        $stmt->execute(array($id));
        $status = $stmt->fetch(PDO::FETCH_ASSOC);
        return $status['name'];
    } catch(PDOException $e) {
        return -1;
    }
}

//function to add status
function add_status($name){
    global $dbh;
    try {
        $stmt = $dbh->prepare('INSERT INTO status (name) VALUES (?)');
        $stmt->execute(array($name));
        return 1;
    } catch(PDOException $e) {
        return -1;
    }
}
?>