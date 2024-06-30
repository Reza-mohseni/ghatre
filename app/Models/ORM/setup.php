<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = $_POST['servername'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dbname = $_POST['dbname'];

    // ذخیره اطلاعات در فایل .env
    $envContent = "DB_SERVERNAME=$servername\nDB_USERNAME=$username\nDB_PASSWORD=$password\nDB_NAME=$dbname\n";
    file_put_contents('.env', $envContent);

    // ایجاد اتصال به پایگاه داده
    $conn = new mysqli($servername, $username, $password);

    // بررسی اتصال
    if ($conn->connect_error) {
        die("اتصال ناموفق: " . $conn->connect_error);
    }

    // بررسی وجود پایگاه داده
    $db_selected = mysqli_select_db($conn, $dbname);

    if (!$db_selected) {
        // ایجاد پایگاه داده اگر وجود نداشت
        $sql = "CREATE DATABASE $dbname";
        if ($conn->query($sql) === TRUE) {
            echo "پایگاه داده با موفقیت ایجاد شد";
        } else {
            die("خطا در ایجاد پایگاه داده: " . $conn->error);
        }
        $conn->select_db($dbname);
    } else {
        $conn->select_db($dbname);
    }

    // بررسی وجود جدول و ایجاد آن در صورت نیاز
    $sql = "CREATE TABLE IF NOT EXISTS Users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
        echo "جدول Users با موفقیت ایجاد شد یا وجود داشت";
    } else {
        die("خطا در ایجاد جدول: " . $conn->error);
    }

    // بستن اتصال
    $conn->close();

    // هدایت به صفحه اصلی پس از تنظیم
    header('Location: index.php');
    exit();
} else {
    echo "لطفاً از فرم برای ارسال اطلاعات استفاده کنید.";
}
?>
