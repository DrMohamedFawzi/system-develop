<?php
include 'db.php'; // تأكد من وجود ملف db.php لربط قاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = 1; // يجب أن يكون معرف المندوب من الجلسة
    $familyName = $_POST['family_name'];
    $childrenDetails = $_POST['children_details'];
    $pregnantWomenDetails = $_POST['pregnant_women_details'];

    $customFields = isset($_POST['custom_field']) ? $_POST['custom_field'] : [];
    $childNames = isset($_POST['child_name']) ? $_POST['child_name'] : [];
    $childIDs = isset($_POST['child_id']) ? $_POST['child_id'] : [];
    $childBirths = isset($_POST['child_birth']) ? $_POST['child_birth'] : [];
    $childParents = isset($_POST['child_parent']) ? $_POST['child_parent'] : [];

    $stmt = $conn->prepare("INSERT INTO families (user_id, family_name, children_details, pregnant_women_details) VALUES (:user_id, :family_name, :children_details, :pregnant_women_details)");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':family_name', $familyName);
    $stmt->bindParam(':children_details', $childrenDetails);
    $stmt->bindParam(':pregnant_women_details', $pregnantWomenDetails);

    if ($stmt->execute()) {
        $familyId = $conn->lastInsertId();

        // إضافة الحقول المخصصة
        foreach ($customFields as $field) {
            $stmt = $conn->prepare("INSERT INTO custom_fields (family_id, field_value) VALUES (:family_id, :field_value)");
            $stmt->bindParam(':family_id', $familyId);
            $stmt->bindParam(':field_value', $field);
            $stmt->execute();
        }

        // إضافة الأطفال
        if (count($childNames) > 0) {
            for ($i = 0; $i < count($childNames); $i++) {
                $stmt = $conn->prepare("INSERT INTO children (family_id, name, id_number, birth_date, parent_name) VALUES (:family_id, :name, :id_number, :birth_date, :parent_name)");
                $stmt->bindParam(':family_id', $familyId);
                $stmt->bindParam(':name', $childNames[$i]);
                $stmt->bindParam(':id_number', $childIDs[$i]);
                $stmt->bindParam(':birth_date', $childBirths[$i]);
                $stmt->bindParam(':parent_name', $childParents[$i]);
                $stmt->execute();
            }
        }

        echo "تمت إضافة بيانات العائلة بنجاح";
    } else {
        echo "حدث خطأ أثناء إضافة بيانات العائلة";
    }
}
?>