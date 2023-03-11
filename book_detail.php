<?php
session_start();

// Xử lý khi người dùng nhấn nút "Xem chi tiết"
if (isset($_POST['view_detail'])) {
  $category_code = $_POST['category_code'];
  $category_name = $_POST['category_name'];
  $category_books = array();

  // Lọc các sách có mã thể loại trùng với mã thể loại được chọn
  foreach ($_SESSION['book_array'] as $book) {
    if ($book['category_code'] == $category_code) {
      $category_books[] = $book;
    }
  }
}
?>
    
<html>
<head>
  <title>Danh sách sách</title>
  <link rel="stylesheet" type="text/css" href="style1.css">

</head>
<body>
<h2 style="text-align: center;">Danh sách sách thuộc thể loại <span class="highlight"><?php echo $category_name; ?></span></h2>
    <!DOCTYPE html>
  <?php if (count($category_books) == 0) { ?>
    <p style="text-align: center;">Không có sách trong thể loại này.</p>
    <form method="get" action="category_list.php">
      <button type="submit">Quay lại</button>
    </form>
  <?php } else { ?>
    <table border="1" style="width: 780px; margin-left: auto; margin-right: auto;">
      <tr>
        <th>Tên sách</th>
        <th>Tác giả</th>
        <th>Ngày phát hành</th>
      </tr>
      <?php foreach ($category_books as $book) { ?>
        <tr>
          <td><?php echo $book['category_code']; ?></td>
          <td><?php echo $book['book_title']; ?></td>
          <td><?php echo $book['release_date']; ?></td>
        </tr>
      <?php } ?>
      <form method="get" action="category_list.php" style="width: 780px; margin-left: auto; margin-right: auto;">
        <button type="submit">Quay lại</button>
      </form>
    </table>
  <?php } ?>
</body>
</html>