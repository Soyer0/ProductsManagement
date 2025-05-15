<?php
require __DIR__ . '/config/config.php';
require __DIR__ . '/controllers/ProductController.php';

$controller = new ProductsController();

$action = $_GET['action'] ?? 'showProducts';

switch ($action) {
    case 'showProducts':
        $controller->showProducts();
        break;
    case 'getProduct':
        $controller->getProduct();
        break;
    case 'addProductMpn':
        $controller->addProductMpn();
        break;
    case 'updateProductMpn':
        $controller->updateProductMpn();
        break;
    case 'deleteProductMpn':
        $controller->deleteProductMpn();
        break;
    default:
        echo "404 Not Found";
        break;
}