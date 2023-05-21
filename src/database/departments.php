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

//function to get agents departments
function get_agent_departments(){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM agent_department');
        $stmt->execute();
        $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $departments;
    } catch(PDOException $e) {
        return -1;
    }
}


//function to get department by agent id
function get_departments_by_agent_id($agent_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT department_id FROM agent_department WHERE agent_id = ?');
        $stmt->execute(array($agent_id));
        $departments = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        return $departments;
    } catch(PDOException $e) {
        return [];
    }
}


//function to remove agent from department
function remove_agent_from_department($agent_id,$department_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('DELETE FROM agent_department WHERE agent_id = ? AND department_id = ?');
        $stmt->execute(array($agent_id,$department_id));
        return 1;
    } catch(PDOException $e) {
        return -1;
    }
}






?>