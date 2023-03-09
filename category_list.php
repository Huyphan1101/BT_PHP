<?php
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
// Xóa thể loại sách
if (isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];
    foreach ($_SESSION['categories'] as $key => $category) {
        if ($category['id'] == $category_id) {
            unset($_SESSION['categories'][$key]);
            break;
        }
    }
}

// Hiển thị danh sách thể loại sách
function displayCategories() {
    if (isset($_SESSION['categories'])) {
        foreach ($_SESSION['categories'] as $category) {
            echo '<tr>';
            echo '<td>' . $category['id'] . '</td>';
            echo '<td>' . $category['code'] . '</td>';
            echo '<td>' . $category['name'] . '</td>';
            echo '<td>' . $category['status'] . '</td>';
            echo '<td><a href="update_category.php?id=' . $category['id'] . '">Sửa</a> | <form method="post" style="display: inline;"><input type="hidden" name="category_id" value="' . $category['id'] . '">
            <button type="submit" name="delete_category" onclick="return confirm(\'Bạn chắc chắn muốn xóa thể loại sách này?\')">Xóa</button></form></td>';
            echo '</tr>';
        }
    }
}
//Tìm kiếm tên thể loại 
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $results = array();
    foreach ($_SESSION['categories'] as $category) {
        if ($category['name'] === $keyword ) {
            $results[] = $category;
        }
    }
    if (count($results) > 0) {
        echo '<h3>Kết quả tìm kiếm:</h3>';
        echo '<ul>';
        foreach ($results as $category) {
            echo '<form>';
            echo '<li>';
            echo 'ID: ' . $category['id'] . '<br>';
            echo '<li>';
            echo 'Mã thể loại: ' . $category['code'] . '<br>';
            echo '<li>';
            echo 'Tên thể loại: ' . $category['name'] . '<br>';
            echo '<li>';
            echo 'Trạng thái: ' . $category['status'] . '<br>';
            echo '</li>';
            echo '</form>';
        }
        echo '</ul>';
    } else {
        echo 'Không tìm thấy kết quả nào cho từ khóa "' . $keyword . '".';
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản lý thể loại sách</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1, h2 {
            text-align: center;
        }

        form {
            width: 780px;
            margin: 0 auto;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        input[type=text], input[type=submit] {
            padding: 5px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            margin-left: 10px;
        }

        a {
            display: inline-block;
            padding: 5px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-left: 10px;
        }

        table {
            border-collapse: collapse;
            width: 780px;
            margin: 0 auto;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Quản lý thể loại sách</h1>
    <p>Xin chào: <?php echo $_SESSION['fullname']; ?> (<a href="login.php">Đăng xuất</a>)</p>
    <h2 style="text-align: center">Danh sách thể loại sách</h2>
    <div>
    <form action="" method="post" style="width: 780px; margin-left: auto; margin-right: auto;">
        <label>Tìm kiếm tên thể loại: </label>
        <input type="text" id="keyword" name="keyword">
        <input type="submit" value="Tìm kiếm">
        <br>
        <br>
        
        <a href="add_category.php" style="text-align:center;">Thêm thể loại sách</a>
    </form>
</div>
    <br>
    <table border="1" style="width: 780px; margin-left: auto; margin-right: auto;" >
        <tr>
            <th>ID</th>
            <th>Mã thể loại</th>
            <th>Tên thể loại</th>
            <th>Trạng thái</th>
            <th>Tác vụ</th>
        </tr>
        <?php displayCategories(); ?>
    </table>
    
</body>
</html>

