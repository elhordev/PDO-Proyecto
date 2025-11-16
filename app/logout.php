<?php 


require_once __DIR__ . '\..\app\services\SessionService.php';
use services\SessionService;



$sessionService = SessionService::getInstance();

$sessionService->logout();

header('location:../app/login.php');

?>