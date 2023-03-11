<?php
   session_start();

   if (!isset($_SESSION['book_array'])) {
     $_SESSION['book_array'] = array(
       array(
         'category_code' => 'LS',
         'book_title' => 'Đắc nhân tâm',
         'author_name' => 'Dale Carnegie',
         'release_date' => '08-08-2016'
       ),
       array(
         'category_code' => 'TT',
         'book_title' => 'Làm giàu không khó',
         'author_name' => 'Phạm Thanh Hưng',
         'release_date' => '20-02-2020'
       ),
       array(
         'category_code' => 'VH',
         'book_title' => 'Sapiens: Lược sử loài người',
         'author_name' => 'Yuval Noah Harari',
         'release_date' => '10-02-2015'
       )
     );
   }
  
   if(isset($_POST['add_book']))
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_category_code = $_POST['category_book'];

    // Kiểm tra xem các trường dữ liệu đã được nhập đầy đủ hay chưa
    if (!empty($_POST['category_code']) && !empty($_POST['book_title']) && !empty($_POST['author_name']) && !empty($_POST['release_date'])) {
      // Thêm cuốn sách mới vào mảng session
       $date = date_create($_POST['release_date']);
  $release_date = date_format($date, 'd-m-Y');
      $new_book = array(
        'category_code' => $selected_category_code,
        'book_title' => $_POST['book_title'],
        'author_name' => $_POST['author_name'],
        'release_date' => $release_date
      );
      
      $_SESSION['book_array'][] = $new_book;
      
      // Hiển thị thông báo thành công
      echo "Thêm sách thành công!";
    } else {
      // Hiển thị thông báo lỗi nếu các trường dữ liệu không được nhập đầy đủ
       echo "Xin chào :"  .$_SESSION['fullname']; 
    }
  }
  // load mã
  // Xóa
  if(isset($_POST['delete'])) {
    $index = $_POST['delete'];
    // Xóa phần tử có key tương ứng
    unset($_SESSION['book_array'][$index]);
    // Cập nhật lại mảng
    $_SESSION['book_array'] = array_values($_SESSION['book_array']);
}
 

// Sửa thông tin
if(isset($_POST['edit'])) {
  $key = $_POST['key'];
  $category = $_POST['category_code'];
  $title = $_POST['book_title'];
  $author = $_POST['author_name'];
  $publish_date = date('d-m-Y', strtotime($_POST['release_date']));

  $books = $_SESSION['book_array'];

  $books[$key] = array(
    'category_code' => $category,
    'book_title' => $title,
    'author_name' => $author,
    'release_date' => $publish_date
  );

  $_SESSION['book_array'] = $books;
}


  // Tìm kiếm 
  if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $results = array();
    foreach ($_SESSION['book_array'] as $books) {
        if ($books['category_code'] == $keyword | $books['book_title'] == $keyword | $books['author_name'] == $keyword ) {
            $results[] = $books;
        }
    }
    if (count($results) > 0) {
       
        echo '<ul>';
        foreach ($results as $books) {
            echo '<form>';
            echo '<h3 style="text-align: center;">Kết quả tìm kiếm:</h3>';
            echo '<li>';
            echo 'Mã thể loại: ' . $books['category_code'] . '<br>';
            echo '<li>';
            echo 'Tên sách: ' . $books['book_title'] . '<br>';
            echo '<li>';
            echo 'Tên tác giả: ' . $books['author_name'] . '<br>';
            echo '<li>';
            echo 'Thời gian phát hành: ' . $books['release_date'] . '<br>';
            echo '</li>';
            echo '</form>';
        }
        echo '</ul>';
    } else  {
        // echo 'Không tìm thấy kết quả nào cho từ khóa "' . $keyword . '".';
    }
}
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
  $results = array_filter($_SESSION['book_array'], function($book) {
      $release_date = date_create($book['release_date']);
      $start_date = date_create($_POST['start_date']);
      $end_date = date_create($_POST['end_date']);
      return ($release_date >= $start_date && $release_date <= $end_date);
  });
  if (count($results) > 0) {
      echo "<h3> Kết quả tìm kiếm: </h3>";
      echo '<ul>';
      foreach ($results as $book) {
          echo '<li>';
          echo 'Tên thể loại: ' . $book['category_code'] . '<br>';
          echo '<li>';
          echo 'Tên sách: ' . $book['book_title'] . '<br>';
          echo '<li>';
          echo 'Tên tác giả: ' . $book['author_name'] . '<br>';
          echo '<li>';
          echo 'Thời gian phát hành: ' . $book['release_date'] . '<br>';
          echo '</li>';
      }
      echo '</ul>';
  } else {
      echo 'Không tìm thấy kết quả nào.';
  }
}


?>


<br>

<!DOCTYPE html>
<html>
<head>
  <title>Quản lý thông tin sách</title>
</head>
<body>
<h1 style="text-align: center;">Danh sách sác cuốn sách</h1>
<form action="" method="post" style="width: 780px; margin-left: auto; margin-right: auto;">
        <label style= "text-align: center;">Tìm kiếm sách </label>  <input placeholder="Nhập từ khóa tìm kiếm" type="text" id="keyword" name="keyword" >
        <input type="submit" value="Tìm kiếm">
        <br>
        <br>
        <label for="start_date">Ngày bắt đầu:</label>
        <input type="date" name="start_date" id="start_date" >
        <br>
        <label for="end_date">Ngày kết thúc:</label>
        <input type="date" name="end_date" id="end_date" >
        <br>
        <br>
        <input type="submit" value="Tìm kiếm theo ngày">
 </form>
 <br>

<?php
  $books = $_SESSION['book_array'];

  echo '<table border="1" style="width: 780px; margin-left: auto; margin-right: auto;">';
  echo '<tr><th>Mã thể loại</th><th>Tên sách</th><th>Tên tác giả</th><th>Ngày phát hành</th><th>Thao tác</th></tr>';

  foreach($books as $key => $book) {
    echo '<tr>';
    echo '<td>'.$book['category_code'].'</td>';
    echo '<td>'.$book['book_title'].'</td>';
    echo '<td>'.$book['author_name'].'</td>';
    echo '<td>'.$book['release_date'].'</td>';
    echo '<td><a href="book_list.php?key='.$key.'">Chỉnh sửa</a></td>';
    echo "<td><form method='POST'><button type='submit' name='delete' value='".$key."'>Xóa</button></form></td>";
    echo '</tr>';
  }

  echo '</table>';
?>

<br><br>

<?php
if(isset($_GET['key'])) {
  $key = $_GET['key'];
  $book = $books[$key];
?>

<h2>Chỉnh sửa thông tin sách</h2>

<form method="post">
  <input type="hidden" name="key" value="<?php echo $key; ?>">
  <label for="category_code">Mã thể loại:</label>
    <select name="category_code" id="category_code">
        <?php foreach ($_SESSION['categories'] as $key) { ?>
            <option value="<?php echo $key['code']; ?>"
            <?php if (isset($book) && $book['category_code'] == $key['code']) {
                echo 'selected';
            } ?>>
                <?php echo $key['code']; ?>
            </option>
        <?php } ?>
    </select>
  <label>Tên sách:</label>
  <input type="text" name="book_title" value="<?php echo $book['book_title']; ?>"><br><br>
  <label>Tên tác giả:</label>
  <input type="text" name="author_name" value="<?php echo $book['author_name']; ?>"><br><br>
  <label>Ngày phát hành:</label>
  <input type="date" name="release_date" value="<?php echo $book['release_date']; ?>"><br><br>
  <input type="submit" name="edit" value="Lưu thông tin">
</form>

<?php } ?>

</body>
</html>

<br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet"  href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sách</title>
</head>
<body>
<div>
    <br>
<form method="post" action="book_list.php">
<label for="category_code">Mã thể loại:</label>
    <select name="category_code" id="category_code">
        <?php foreach ($_SESSION['categories'] as $key) { ?>
            <option value="<?php echo $key['code']; ?>"
            <?php if (isset($book) && $book['category_code'] == $key['code']) {
                echo 'selected';
            } ?>>
                <?php echo $key['code']; ?>
            </option>
        <?php } ?>
    </select>
  <label>Tên sách:</label>
  <input type="text" name="book_title" required><br>
  
  <label>Tên tác giả:</label>
  <input type="text" name="author_name" required><br>
  
  <label>Ngày phát hành:</label>
  <input type="date" name="release_date" required><br>

  <br>
  
  <input type="submit"name="add_book" value="Thêm sách">
</form>
</div>
</body>
</html>

    