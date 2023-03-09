<?php
session_start();
if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = array(
        array('id' => 1, 'code' => 'TT', 'name' => 'Trinh thám', 'status' => 'hoạt động'),
        array('id' => 2, 'code' => 'KN', 'name' => 'Khoa học tự nhiên', 'status' => 'hoạt động'),
        array('id' => 3, 'code' => 'VH', 'name' => 'Văn học', 'status' => 'không hoạt động')
    );
}

//Thêm thể loại sách mới
if (isset($_POST['add_category'])) {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $categories = $_SESSION['categories'];
    $new_category = array(
        'id' => $id,
        'code' => $code,
        'name' => $name,
        'status' => $status
    );
    $categories[] = $new_category;
    $_SESSION['categories'] = $categories;
    echo "Thêm thể loại thành công.";
    header('Location:category_list.php');
}

?>

<div>
    <h1 style="text-align: center;">Thêm thể loại sách</h1>
</div>
<div>
    <table border="1" style="width: 780px; margin-left: auto; margin-right: auto;">
        <tr>
            <th>ID </th>
            <th>Mã thể loại </th>
            <th>Tên thể loại </th>
            <th>Trạng thái </th>
        </tr>
        <?php foreach ($_SESSION['categories'] as $key) { ?>
            <tr>
                <td><?= $key['id'] ?></td>
                <td><?= $key['code'] ?></td>
                <td><?= $key['name'] ?></td>
                <td><?= $key['status'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
<br>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet"  href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
    <form method="POST" action="add_category.php" >
        <label>Mã thể loại:</label>
        
        <input type="text" name="code" required> <br><br>
        
        <label>Tên thể loại</label>
        <input type="text" name="name" required><br><br>

        <label>Trạng thái: </label>
            <select name="status" id="" required>
                <option value="hoạt động">Hoạt động</option>
                <option value="không hoạt động">Không hoạt động</option>
            </select><br><br>
        
        <input type="hidden" name="id" value="<?= count($_SESSION['categories']) + 1 ?>">
        <input type="submit" value="Thêm thể loại" name="add_category">
    </form>
</div>
</body>
</html>