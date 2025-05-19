<?php

require_once 'Model.php';
class UsersModel extends Model
{
    public function getColumns(): bool|array|null
    {
        $columns =  $this->db->getTableFields('wl_user_types');
        $columns = array_map(fn($field) => $field->Field, $columns);
        return array_filter($columns, fn($col) => $col !== 'active');
    }

    public function getAllUsers(): string|array|null
    {
        return  $this->db->getAllData('wl_user_types');
    }

    public function updateActiveStatus(int $id, int $status): array|bool
    {
        $user = $this->db->getAllDataById("wl_user_types", $id);
        if ($user->name === "admin" || $user->name === "manager") {
            return ['error' => 'Cannot update active status for managers and admins'];
        }

        return $this->db->updateRow('wl_user_types',
            ['active' => $status],
            $id);
    }

    public function addUser(string $name, string $title, int $canLogin): array|bool
    {
        $newUserId = $this->db->insertRow('wl_user_types',[
            'name' => $name,
            'title' => $title,
            'can_login' => $canLogin,
            'active' => 1,
        ]);

        if (!$newUserId) {
            return ['error' => 'Cannot add new user'];
        }

        return [
            'id' => $newUserId,
            'name' => $name,
            'title' => $title,
            'can_login' => $canLogin,
            'active' => 1,
        ];
    }

    public function getUser(int $id)
    {
        $user = $this->db->getAllDataById("wl_user_types", $id);
        if(!$user){
            return ['error' => 'Cannot get user'];
        }

        return $user;
    }

    public function editUser(int $id, string $name, string $title, int $canLogin)
    {
        $isUpdated = $this->db->updateRow('wl_user_types', [
            'name' => $name,
            'title' => $title,
            'can_login' => $canLogin,
            ], $id);

        if (!$isUpdated) {
            return ['error' => 'Cannot edit user'];
        }

        return [
            'id' => $id,
            'name' => $name,
            'title' => $title,
            'can_login' => $canLogin,
        ];
    }

    public function deleteUser(int $id): array|bool
    {
        return $this->db->deleteRow('wl_user_types', $id);
    }
}