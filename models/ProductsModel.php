<?php
require_once 'Model.php';
class ProductsModel extends Model {
    public function getColumns(): bool|array|null
    {
        $neededFields = ['id', 'mpn', 'price_base_uk', 'active', 'updated_at'];
        $columns =  $this->db->getTableFields('s_shopshowcase_products');
        $filteredFields = array_filter($columns, function($field) use ($neededFields) {
            return in_array($field->Field, $neededFields);
        });
        return array_map(fn($field) => $field->Field, $filteredFields);
    }

    public function getAllProducts(): string|array|null
    {
        return  $this->db->getAllData("s_shopshowcase_products", "id LIMIT 20");
    }

    public function getProductById(int $id)
    {
        return $this->db->getAllDataByFieldInArray('s_shopshowcase_products_mpn', $id, 'product_id');
    }

    public function addProductMpn(int $productId, string $mpn) : int|false
    {
        $mpnIndex = preg_replace('/[^a-zA-Z0-9]/', '', $mpn);
        return $this->db->insertRow('s_shopshowcase_products_mpn',
            ['product_id' => $productId,
            'mpn' => $mpn,
            'mpn_index' => $mpnIndex]);
    }

    public function updateProductMpn(int $id, string $mpn) : bool
    {
        $mpnIndex = preg_replace('/[^a-zA-Z0-9]/', '', $mpn);
        return $this->db->updateRow('s_shopshowcase_products_mpn',
            ['mpn' => $mpn,
            'mpn_index' => $mpnIndex],
            $id);
    }

    public function deleteProductMpn(int $id): bool
    {
        return $this->db->deleteRow('s_shopshowcase_products_mpn', $id);
    }
}