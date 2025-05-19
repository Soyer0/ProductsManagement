<?php
require __DIR__ . '/config/config.php';
require __DIR__ . '/controllers/ProductController.php';
require __DIR__ . '/controllers/UserController.php';

session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

if (!isset($_SESSION['all_languages'])) {
    $_SESSION['all_languages'] = ['en'];
}

if (!isset($GLOBALS['multilanguage_type'])) {
    $GLOBALS['multilanguage_type'] = 'main domain';
}

$productController = new ProductsController();
$userController = new UserController();

$table = $_GET['table'] ?? '';
if ($table === 'users') {
    $action = $_GET['action'] ?? 'showUsers';
} else {
    $action = $_GET['action'] ?? 'showProducts';
}

if ($table === 'users') {
    switch ($action) {
        case 'showUsers':
            $userController->showUsers();
            break;
        case 'activateUser':
            $userController->activateUser();
            break;
        case 'deactivateUser':
            $userController->deactivateUser();
            break;
        case 'deleteUser':
            $userController->deleteUser();
            break;
        case 'addUser':
            $userController->addUser();
            break;
        case 'getUser':
            $userController->getUser();
            break;
        case 'editUser':
            $userController->editUser();
            break;
        default:
            echo "404 Not Found (UserController action)";
            break;
    }
} elseif ($table === 'products' || $table === '') {
    switch ($action) {
        case 'showProducts':
            $productController->showProducts();
            break;
        case 'getProduct':
            $productController->getProduct();
            break;
        case 'addProductMpn':
            $productController->addProductMpn();
            break;
        case 'updateProductMpn':
            $productController->updateProductMpn();
            break;
        case 'deleteProductMpn':
            $productController->deleteProductMpn();
            break;
        default:
            echo "404 Not Found (ProductController action)";
            break;
    }
} else {
    echo "404 Not Found (unknown table)";
}
