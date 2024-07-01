<?php

namespace App\Models\ORM;

use PDO;
require_once __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;
class Connection {
    private static $instance = null;

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance === null) {
            // بارگذاری فایل .env
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
            $dotenv->load();

            // دریافت اطلاعات پایگاه داده از متغیرهای محیطی
            $dbHost = $_ENV['DB_HOST'];
            $dbName = $_ENV['DB_NAME'];
            $dbUser = $_ENV['DB_USER'];
            $dbPass = $_ENV['DB_PASS'];

            self::$instance = new PDO(
                "mysql:host=$dbHost;dbname=$dbName",
                $dbUser,
                $dbPass
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}
