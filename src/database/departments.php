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
        $stmt = $dbh->prepare('SELECT name FROM departments WHERE id = ?');
        $stmt->execute(array($id));
        $department = $stmt->fetch(PDO::FETCH_ASSOC);
        return $department['name'];
    } catch(PDOException $e) {
        return -1;
    }
}

//function to get agents in a department
function get_agents_by_department($department_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT agent_id FROM agent_department WHERE department_id = ?');
        $stmt->execute(array($department_id));
        $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $agents;
    } catch(PDOException $e) {
        return -1;
    }
}



?>