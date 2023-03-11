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
            echo '<td>
                <a href="update_category.php?id=' . $category['id'] . '" class="button">Sửa</a> 
                <input type="hidden" name="category_id" value="' . $category['id'] . '">
                <button class="my-button-class" type="submit" name="delete_category" onclick="return confirm(\'Bạn chắc chắn muốn xóa thể loại sách này?\')" class="button">Xóa</button>    
                </td>';   
            echo '<td>
                <form class="form1" method="post" action="book_detail.php">
                <input type="hidden" name="category_code" value="'. $category['code'].'">
                <input type="hidden" name="category_name" value="'. $category['name'].'">
                <button type="submit" name="view_detail" class="detail">Xem chi tiết</button>
                </form>
                </td>';
            echo '</tr>';
        }   }
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
    <link rel="stylesheet" type="text/css" href="style1.css">

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
            <th>Chi tiết</th>
        </tr>
        <?php displayCategories(); ?>
    </table>
    
</body>
</html>

