<?php
require_once __DIR__ .'/../models/UsersModel.php';
require_once(__DIR__ . '/../lib/data.php');

class UserController
{
    private UsersModel $usersModel;
    private Data $data;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->data = new Data();
    }

    public function showUsers(): void
    {
        $users = $this->usersModel->getAllUsers();
        $columns = $this->usersModel->getColumns();
        $content = $this->render('users/index', [
            'users' => $users,
            'columns' => $columns,
        ]);

        echo $this->render('layout', ['content' => $content]);
    }

    public function activateUser(): void
    {
        header('Content-Type: application/json');

        $id = $this->data->post('id');
        if (!$id) {
            echo json_encode(['error' => 'User ID is missing']);
            return;
        }

        $updated = $this->usersModel->updateActiveStatus($id, 1);

        if (is_array($updated) && isset($updated['error'])) {
            echo json_encode(['error' => $updated['error']]);
            return;
        }

        if ($updated) {
            echo json_encode([
                'success' => true,
            ]);
        } else {
            echo json_encode(['error' => 'Failed to activate user']);
        }
    }

    public function deactivateUser(): void
    {
        header('Content-Type: application/json');

        $id = $this->data->post('id');
        if (!$id) {
            echo json_encode(['error' => 'User ID is missing']);
            return;
        }

        $updated = $this->usersModel->updateActiveStatus($id, 0);

        if (is_array($updated) && isset($updated['error'])) {
            echo json_encode(['error' => $updated['error']]);
            return;
        }

        if ($updated) {
            echo json_encode([
                'success' => true,
            ]);
        } else {
            echo json_encode(['error' => 'Failed to deactivate user']);
        }
    }

    public function deleteUser(): void
    {
        header('Content-Type: application/json');
        $id = $this->data->post('id');

        if (!$id) {
            echo json_encode(['error' => 'User ID is missing']);
            return;
        }

        if ($this->usersModel->deleteUser($id)) {
            echo json_encode([
                'success' => true,
            ]);
        } else {
            echo json_encode(['error' => 'Something went wrong']);
        }

    }

    function addUser(): void
    {
        header('Content-Type: application/json');
        $name = $this->data->post('name');
        if ($name === '' || $name === null) {
            echo json_encode(['error' => 'Name is missing']);
        }

        $title = $this->data->post('title');
        if ($title === '' || $title === null) {
            echo json_encode(['error' => 'Title is missing']);
        }

        $canLogin = $this->data->post('canLogin') ?? 0;

        $user = $this->usersModel->addUser($name, $title, $canLogin);

        if (isset($user['error'])) {
            echo json_encode(['error' => $user['error']]);
            return;
        }

        if($user){
            echo json_encode([
                'success' => true,
                'user' =>  $user,
            ]);
        }
        else {
            echo json_encode(['error' => 'Failed to add user']);
        }
    }

    public function getUser(): void
    {
        header('Content-Type: application/json');
        $id = $this->data->post('id');

        if (!$id) {
            echo json_encode(['error' => 'User ID is missing']);
            return;
        }

        $user = $this->usersModel->getUser($id);

        if (is_array($user) && isset($user['error'])) {
            echo json_encode(['error' => $user['error']]);
            return;
        }

        if($user){
            echo json_encode([
                'success' => true,
                'user' =>  $user,
            ]);
        }
        else {
            echo json_encode(['error' => 'Failed to get user']);
        }
    }

    public function editUser(): void
    {
        header('Content-Type: application/json');
        $id = $this->data->post('id');

        if (!$id) {
            echo json_encode(['error' => 'User ID is missing']);
            return;
        }

        $name = $this->data->post('name');
        if ($name === '' || $name === null) {
            echo json_encode(['error' => 'Name is missing']);
        }

        $title = $this->data->post('title');
        if ($title === '' || $title === null) {
            echo json_encode(['error' => 'Title is missing']);
        }

        $canLogin = $this->data->post('canLogin') ?? 0;

        $user = $this->usersModel->editUser($id, $name, $title, $canLogin);

        if (is_array($user) && isset($user['error'])) {
            echo json_encode(['error' => $user['error']]);
            return;
        }

        if($user){
            echo json_encode([
                'success' => true,
                'user' =>  $user,
            ]);
        }
        else {
            echo json_encode(['error' => 'Failed to edit user']);
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