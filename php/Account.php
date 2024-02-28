<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/Image/icon.png">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/css/Login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>

    <script>
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
            session_destroy();
            session_commit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $stmt = $conn->prepare("SELECT password FROM accounts WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $dbpassword = $row['password'];
                $stmt->close();
                if(password_verify($password, $dbpassword)){
                        $stmt = $conn->prepare("SELECT username FROM admin WHERE username = ?");
                        $stmt->bind_param("s", $username);
                        $stmt->execute();
                        $adminResult = $stmt->get_result();
                        $stmt->close();
                        $stmt = $conn->prepare("SELECT username FROM student WHERE username = ?");
                        $stmt->bind_param("s", $username);
                        $stmt->execute();
                        $studentResult = $stmt->get_result();
                        $stmt->close();
                        if ($adminResult->num_rows == 1) {
                            $stmt = $conn->prepare("SELECT Name FROM admin WHERE username = ?");
                            $stmt->bind_param("s", $username);
                            if ($stmt->execute()) {
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $name = $row['Name'];
                                $stmt->close();
                            }
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['name'] = $name;
                            header("Location: /php/AdminPage.php");
                            exit();
                        } elseif ($studentResult->num_rows == 1) {
                            $stmt = $conn->prepare("SELECT SName FROM student WHERE username = ?");
                            $stmt->bind_param("s", $username);
                            if ($stmt->execute()) {
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $Sname = $row['SName'];
                                $stmt->close();
                            }
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['Sname'] = $Sname;
                            header("Location: /php/MainWebsite.php");
                            exit();
                        } else {
                            echo 'alert("Opps... Thử lại nhé!");';
                        }
                }else {
                    echo 'alert("Tên người dùng hoặc mật khẩu không đúng.");';
                }
            }else {
                echo 'alert("Tên người dùng hoặc mật khẩu không đúng.");';
            }
            
        }

        $conn->close();
        ?>
    </script>
</body>

</html>