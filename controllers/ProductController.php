<?php
require_once __DIR__ .'/../models/ProductsModel.php';

class ProductsController
{
    private ProductsModel $productsModel;

    public function __construct()
    {
        $this->productsModel = new ProductsModel();
    }

    public function showProducts(): void
    {
        $products = $this->productsModel->db->getAllData("s_shopshowcase_products", "id LIMIT 20");
        $columns = $this->productsModel->getAllProducts();
        $content = $this->render('products/index', [
            'products' => $products,
            'columns' => $columns,
        ]);

        echo $this->render('layout', ['content' => $content]);
    }

    public function getProduct(): void
    {
        header('Content-Type: application/json');

        $productId = $_POST['productId'] ?? null;
        if (!$productId) {
            echo json_encode(['error' => 'Empty productId']);
            return;
        }

        $product = $this->productsModel->getProductById($productId);

        if ($product) {
            echo json_encode([
                'success' => true,
                'products' => $product
            ]);
        } else {
            echo json_encode(['error' => 'Product not found']);
        }
    }

    public function addProductMpn(): void
    {
        header('Content-Type: application/json');

        $productId = $_POST['productId'] ?? null;
        if (!$productId) {
            echo json_encode(['error' => 'Empty productId']);
            return;
        }
        $mpn = $_POST['newMpn'] ?? null;
        if (!$mpn) {
            echo json_encode(['error' => 'Empty mpn']);
            return;
        }
        $newId = $this->productsModel->addProductMpn($productId, $mpn);
        if ($newId) {
            echo json_encode([
                'success' => true,
                'id' => $newId
            ]);
        } else {
            echo json_encode(['error' => 'Product not found']);
        }
    }

    function updateProductMpn(): void
    {
        header('Content-Type: application/json');

        $id = $_POST['id'] ?? null;
        if(!$id){
            echo json_encode(['error' => 'Empty id']);
            return;
        }
        $mpn = $_POST['newMpn'] ?? null;
        if (!$mpn) {
            echo json_encode(['error' => 'Empty mpn']);
            return;
        }

        if ($this->productsModel->updateProductMpn($id, $mpn)) {
            echo json_encode([
                'success' => true,
            ]);
        } else {
            echo json_encode(['error' => 'Something went wrong']);
        }
    }

    function deleteProductMpn(): void
    {
        header('Content-Type: application/json');

        $id = $_POST['id'] ?? null;
        if(!$id){
            echo json_encode(['error' => 'Empty id']);
            return;
        }

        if ($this->productsModel->deleteProductMpn($id)) {
            echo json_encode([
                'success' => true,
            ]);
        } else {
            echo json_encode(['error' => 'Something went wrong']);
        }
    }

    private function render($view, $data = []): bool|string
    {
        extract($data);
        ob_start();
        include "views/$view.php";
        return ob_get_clean();
    }
}