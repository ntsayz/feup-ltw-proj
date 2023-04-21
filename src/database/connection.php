<?php function getDatabaseConnection(){
    $db = new PDO('sqlite:database/ticketmanagement.db');
    return $db;
}
?>
