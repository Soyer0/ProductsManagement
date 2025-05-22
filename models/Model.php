<?php
require_once(__DIR__ . '/MyDb.php');
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../lib/function.php');
class Model {
    public MyDb $db;
    public function __construct() {
        $this->db = new MyDb(['host' => DB_HOST, 'user' => DB_USER, 'password' => DB_PASS, 'database' => DB_NAME]);
    }
}

