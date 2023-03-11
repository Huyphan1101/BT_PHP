<?php
session_start();
// Cập nhật thể loại
if (isset($_POST['update_category'])) {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    foreach ($_SESSION['categories'] as &$category) {
        if ($category['id'] == $id) {
            $category['code'] = $code;
            $category['name'] = $name;
            $category['status'] = $status;
            echo "Cập nhật thể loại thành công.";
            header('Location: category_list.php');
            break;
        }
    }
}

// Hiển thị form cập nhật thể loại
if (isset($_POST['edit_category'])) {
    $id = $_POST['id'];
    $category = null;
    foreach ($_SESSION['categories'] as $c) {
        if ($c['id'] == $id) {
            $category = $c;
            break;
        }
    }
    if ($category) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style1.css">

    <title>Sửa thể loại </title>
</head>
<body>
<div>
            <h2 style="text-align: center;">Cập nhật thể loại</h2>
            <form method="POST" action="update_category.php">
                <div>
                    <label for="code">Mã thể loại:</label>
                    &nbsp;&nbsp;
                    <br>
                    <input type="text" id="code" name="code" value="<?= $category['code'] ?>">
                </div>
                <div>
                    <label for="name">Tên thể loại:</label>
                    &nbsp;
                    <br>
                    <input type="text" id="name" name="name" value="<?= $category['name'] ?>">
                </div>
                <div>
                    <label for="status">Trạng thái:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <br>
                    <!-- <input type="text" id="status" name="status" value="<?= $category['status'] ?>"> -->
                    <select name="status" id="" required>
                <option value="hoạt động">Hoạt động</option>
                <option value="không hoạt động">Không hoạt động</option>
                
            </select>
            
                </div>
                <br>
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                <input type="submit" value="Lưu" name="update_category" onclick="alert('Lưu thành công')">
                
            </form>
            <br>
        </div>
<?php
    }
}

?>
    
</body>
</html>

