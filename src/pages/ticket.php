<?php

require_once(__DIR__.'/../initialization/init.php');
require_once(__DIR__.'/../database/tickets.php');
$ticket_id = $_GET['ticket_id'];
$ticket = get_ticket_by_id($ticket_id);

require_once(__DIR__.'/../templates/common/ticket_standalone.php');

?>