<?php
$host = 'localhost'; // أو عنوان السيرفر
$db = 'development'; // اسم قاعدة البيانات
$user = 'mohammed'; // اسم المستخدم
$pass = 'Admin'; // كلمة المرور

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>