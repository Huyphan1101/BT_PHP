<?php
    session_start();
    // Kiểm tra xem đã đăng nhập hay chưa
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trang quản lý tủ sách</title>
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            font-size: 16px;
            line-height: 1.5;
            background-color: #f2f2f2;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        header h1 {
            font-size: 32px;
            margin: 0;
        }
        header a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            background-color: #ccc;
            transition: background-color 0.2s ease-in-out;
        }
        header a:hover {
            background-color: #fff;
            color: #333;
        }
        nav {
            display: flex;
            justify-content: center;
            list-style: none;
            margin: 0;
            padding: 10px;
            background-color: #ccc;
        }
        nav li {
            margin: 0 20px;
        }
        nav a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            background-color: #fff;
            transition: background-color 0.2s ease-in-out;
        }
        nav a:hover {
            background-color: #333;
            color: #fff;
        }
        main {
            margin: 50px auto;
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <header>
        <h1>Trang quản lý tủ sách</h1>
        <a href="login.php">Đăng xuất</a>
    </header>
    <nav>
        <li><a href="category_list.php">Quản lý thể loại sách</a></li>
        <li><a href="book_list.php">Quản lý sách</a></li>
    </nav>
    <main>
        <h2>Xin chào, <?php echo $_SESSION['fullname']; ?>!</h2>
    </main>
</body>
</html>
