<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>واجهة المندوب</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .dynamic-field {
            margin-bottom: 15px;
        }
    </style>
    <script>
        function addField() {
            const container = document.getElementById('dynamic-fields');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'custom_field[]';
            input.placeholder = 'حقل جديد';
            input.className = 'form-control dynamic-field';
            container.appendChild(input);
        }

        function addChild() {
            const container = document.getElementById('children-details');
            const childDiv = document.createElement('div');
            childDiv.className = 'mb-3';

            const nameInput = document.createElement('input');
            nameInput.type = 'text';
            nameInput.name = 'child_name[]';
            nameInput.placeholder = 'الاسم الرباعي للطفل';
            nameInput.className = 'form-control dynamic-field';

            const idInput = document.createElement('input');
            idInput.type = 'text';
            idInput.name = 'child_id[]';
            idInput.placeholder = 'رقم الهوية';
            idInput.className = 'form-control dynamic-field';

            const birthInput = document.createElement('input');
            birthInput.type = 'date';
            birthInput.name = 'child_birth[]';
            birthInput.className = 'form-control dynamic-field';

            const parentInput = document.createElement('input');
            parentInput.type = 'text';
            parentInput.name = 'child_parent[]';
            parentInput.placeholder = 'اسم الوالد كاملاً';
            parentInput.className = 'form-control dynamic-field';

            childDiv.appendChild(nameInput);
            childDiv.appendChild(idInput);
            childDiv.appendChild(birthInput);
            childDiv.appendChild(parentInput);
            container.appendChild(childDiv);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>إضافة بيانات العائلة</h1>
        <form method="post" action="add_family.php" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="family_name" class="form-control" placeholder="اسم العائلة" required>
            </div>
            <div class="form-group">
                <textarea name="children_details" class="form-control" placeholder="تفاصيل الأطفال"></textarea>
            </div>
            <div class="form-group">
                <textarea name="pregnant_women_details" class="form-control" placeholder="تفاصيل النساء الحوامل"></textarea>
            </div>
            
            <div id="children-details"></div>
            <button type="button" class="btn btn-primary" onclick="addChild()">إضافة طفل</button>
            
            <div id="dynamic-fields"></div>
            <button type="button" class="btn btn-secondary" onclick="addField()">إضافة حقل جديد</button>

            <div class="form-group mt-3">
                <input type="file" name="excel_file" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-success btn-block">إضافة بيانات</button>
        </form>
        
        <h2>تصدير إلى Excel</h2>
        <form method="post" action="export_excel.php">
            <div class="form-check">
                <input type="checkbox" name="fields[]" value="family_name" class="form-check-input">
                <label class="form-check-label">اسم العائلة</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="fields[]" value="children_details" class="form-check-input">
                <label class="form-check-label">تفاصيل الأطفال</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="fields[]" value="pregnant_women_details" class="form-check-input">
                <label class="form-check-label">تفاصيل النساء الحوامل</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">إنشاء ملف Excel</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>