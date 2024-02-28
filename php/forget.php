<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/Image/icon.png">
    <title>Khôi phục   </title>
    <link rel="stylesheet" href="/css/Login.css">

</head>

<body>
    <div class="login-container">
        <h2>Recovery</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Tài khoản/MSSV:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu mới:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Đổi">
            </div>
        </form>
    </div>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "sqlclient";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
}
$stmt = $conn->prepare("SELECT Aid FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows <= 0) {
    header("Location: /php/account.php");
    exit();
}
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $stmt = $conn->prepare("SELECT password FROM accounts WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE accounts SET password = ? Where username = ?");
            $stmt->bind_param("ss", $password, $username);
            if ($stmt->execute()) {
                echo '<script>alert("Đổi mật khẩu thành công!.");</script>';
            } else {
                echo '<script>alert("Đổi mật khẩu thất bại!.");</script>';
            }
            $stmt->close();
        } else {
            echo '<script>alert("MSSV của bạn không tồn tại trong hệ thống!.");</script>';
        }
    }

    $conn->close();
    ?>
</body>

</html>