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

function get_departments_by_agentb($agent_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT departments.* FROM agent_department JOIN departments ON agent_department.department_id = departments.id WHERE agent_department.agent_id = ?');
        $stmt->execute(array($agent_id));
        $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $departments;
    } catch(PDOException $e) {
        return [];
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
function get_departments_by_agent($agent_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM agent_department WHERE agent_id = ?');
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


//function to add agent to department
function add_agent_to_department($agent_id,$department_id){
    global $dbh;
    try {
        $stmt = $dbh->prepare('INSERT INTO agent_department (agent_id,department_id) VALUES (?,?)');
        $stmt->execute(array($agent_id,$department_id));
        return 1;
    } catch(PDOException $e) {
        return -1;
    }
}

//function to add department
function add_department($name){
    global $dbh;
    try {
        $stmt = $dbh->prepare('INSERT INTO departments (name) VALUES (?)');
        $stmt->execute(array($name));
        return 1;
    } catch(PDOException $e) {
        return -1;
    }
}

function is_agent_in_department($agent_id, $department_id) {
    global $dbh;
    try {
        $stmt = $dbh->prepare('SELECT * FROM agent_department WHERE agent_id = ? AND department_id = ?');
        $stmt->execute(array($agent_id, $department_id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result !== false);
    } catch(PDOException $e) {
        return false;
    }
}







?>