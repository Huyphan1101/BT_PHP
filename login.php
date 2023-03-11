<?php
    // Mảng danh sách người dùng
    $_arrayUser = [
        [
            'username' => 'nguyenvana1',
            'password' => 'amnote123',
            'fullname' => 'Phan Quốc Huy'
        ],
        [
            'username' => 'nguyenvana2',
            'password' => 'amnote123',
            'fullname' => 'Lê Nguyễn Anh'
        ]
    ];

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        foreach ($_arrayUser as $user) {
            if ($user['username'] == $username && $user['password'] == $password) {
                $_SESSION['username'] = $username;
                $_SESSION['fullname'] = $user['fullname'];
                header('Location: admin.php');
                exit();
            }
        }
        $error = 'Sai tên đăng nhập hoặc mật khẩu.';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <style>
          /* style cho form */
          form {
            margin: 0 auto;
            width: 300px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }

        /* style cho label */
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* style cho input */
        input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        /* style cho button */
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 5px;
        }

        /* style cho error message */
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Đăng nhập</h1>
    <?php if (isset($error)) { ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username"><br><br>
        <label>Mật khẩu:</label>
        <input type="password" name="password"><br><br>
        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>
