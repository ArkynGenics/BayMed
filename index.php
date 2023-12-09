<?php

$basePath = '/BayMed';
$requestUri = $_SERVER['REQUEST_URI'];
$uriComponents = parse_url($requestUri);
$path = $uriComponents['path'];
$queryString = $uriComponents['query'] ?? '';

switch ($path) {
    case $basePath . '/login':
        include_once 'controllers/LoginController.php';  
        LoginController::index();
        break;
    case $basePath . '/register':
        include_once 'controllers/RegistrationController.php'; 
        RegisterController::index();
        break;
    case $basePath . '/':
        include_once 'controllers/HomeController.php'; 
        HomeController::index();
        break;
    case $basePath . '/logout':
        include_once 'controllers/LogoutController.php'; 
        LogoutController::index();
        break;    
    case $basePath . '/medicines':
        include_once 'controllers/MedicineController.php'; 
        MedicineController::viewAll();
        break;     
    case $basePath . '/medicine':
        include_once 'controllers/MedicineController.php'; 
        MedicineController::viewMedicine();
        break;  
    case $basePath . '/cart':
        include_once 'controllers/CartController.php'; 
        CartController::index();
        break;      
    case $basePath . '/feedback':
        include_once 'controllers/FeedbackController.php'; 
        FeedbackController::index();
        break; 
    case $basePath . '/checkout':
        include_once 'controllers/CheckoutController.php'; 
        CheckoutController::index();
        break;                
    default:
        // Handle 404
        http_response_code(404);
        echo '404 Not Found';
        break;
}