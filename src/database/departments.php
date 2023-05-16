<?php
//function to get departments
function get_departments(){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM departments');
        $stmt->execute();
        $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $departments;
    } catch(PDOException $e) {
        return -1;
    }
}

//function to get department by id
function get_department_by_id($id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM departments WHERE id = ?');
        $stmt->execute(array($id));
        $department = $stmt->fetch(PDO::FETCH_ASSOC);
        return $department;
    } catch(PDOException $e) {
        return -1;
    }
}

?>