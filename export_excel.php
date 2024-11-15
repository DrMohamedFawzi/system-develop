<?php
require 'db.php'; // تأكد من وجود ملف db.php لربط قاعدة البيانات
require 'vendor/autoloader.php'; // استدعاء ملف Autoloader

use PhpOffice\PhpSpreadsheet\src\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استعلام لجلب البيانات من قاعدة البيانات
    $query = "SELECT * FROM excele"; // استبدل your_table_name باسم الجدول الصحيح
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // إنشاء ملف Excel جديد
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // إضافة العناوين
    $sheet->setCellValue('A1', 'Column 1'); // استبدل Column 1 باسم العمود الأول
    $sheet->setCellValue('B1', 'Column 2'); // استبدل Column 2 باسم العمود الثاني

    // إضافة البيانات
    $rowIndex = 2; // بدء الصف الثاني بعد العناوين
    foreach ($results as $row) {
        $sheet->setCellValue('A' . $rowIndex, $row['column1']); // استبدل column1 باسم العمود في قاعدة البيانات
        $sheet->setCellValue('B' . $rowIndex, $row['column2']); // استبدل column2 باسم العمود في قاعدة البيانات
        $rowIndex++;
    }

    // حفظ ملف Excel
    $writer = new Xlsx($spreadsheet);
    $fileName = 'data.xlsx';
    $writer->save($fileName);

    // إرسال الملف كاستجابة للمستخدم
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    readfile($fileName);
    exit;
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export to Excel</title>
</head>
<body>
    <form method="POST">
        <button type="submit">Export to Excel</button>
    </form>
</body>
</html>