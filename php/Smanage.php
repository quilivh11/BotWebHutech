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
    $Sname = $_SESSION['Sname'];
}
$stmt = $conn->prepare("SELECT Sid FROM student WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows <= 0) {
    header("Location: /php/account.php");
    exit();
}
$stmt = $conn->prepare("SELECT * FROM student WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    // Truy vấn thành công, lấy thông tin tài khoản
    $row = $result->fetch_assoc();

    $DOB = $row['DOB'];
    $Class = $row['Class'];
    $Major = $row['Major'];
}
$stmt->close();
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="/Image/icon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.72.0">
    <title>Quản lý tài khoản</title>
    <link rel="stylesheet" href="/css/MainWebsite.css">
    <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/blog/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">

</head>

<body>
<div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a href="/php/MainWebsite.php">
                        <img class="link-secondary" src="/Image/LOGO_HUTECH.png" width="300px">
                    </a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-light" href="/php/MainWebsite.php">HUTECH UNIVERSITY</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="link-secondary" href="#" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24">
                            <title>Search</title>
                            <circle cx="10.5" cy="10.5" r="7.5" />
                            <path d="M21 21l-5.2-5.2" />
                        </svg>
                    </a>
                </div>
                <div class="menuButton">
                    <button id="menuBtn"><a id="item">|||</a></button>
                    <div class="menu" id="menu" style="display: none;">
                        <a id="utitle">Xin chào, <?php echo $Sname; ?>!</a>
                        <a href="/php/Smanage.php" class="textdecor">
                            <option>Quản lý tài khoản</option>
                        </a>
                        <a href="/php/studentcomment.php" class="textdecor">
                            <option>Góp ý của bạn</option>
                        </a>
                        <a href="/php/Account.php" class="textdecor">
                            <option>Đăng xuất</option>
                        </a>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                <a class="p-2" href="/php/MainWebsite.php">Trang Chủ</a>
                <a class="p-2" href="/php/news.php">Tin tức</a>
                <a class="p-2" href="/php/event.php">Sự kiện</a>
                <a class="p-2" href="https://www.hutech.edu.vn/daotao">Phòng - Ban</a>
                <a class="p-2" href="https://www.hutech.edu.vn/khoacntt">Khoa</a>
                <a class="p-2" href="https://www.hutech.edu.vn/e-hutech">Viện</a>
                <a class="p-2" href="https://hoptacdn.hutech.edu.vn/">Trung Tâm</a>
                <a class="p-2" href="https://www.hutech.edu.vn/quocte">Đào Tạo Quốc Tế</a>
                <a class="p-2" href="https://erp1.hutech.edu.vn/#/admin/login/login">Nội Bộ</a>
                <a class="p-2" href="https://lib.hutech.edu.vn/">Thư Viện</a>
                <a class="p-2" href="/php/Comments.php">Góp Ý</a>
                <a class="p-2" href="/html/chatbot.html">Liên Hệ</a>
            </nav>
        </div>

        <script>
            const menuBtn = document.getElementById("menuBtn");
            const menu = document.getElementById("menu");
            menuBtn.addEventListener("click", function(e) {
                if (menu.style.display === "block" || menu.style.display === "") {
                    menu.style.display = "none";
                } else {
                    menu.style.display = "block";
                }
                e.stopPropagation();
            });
            document.addEventListener("click", function(e) {
                if (e.target !== menuBtn && e.target !== menu) {
                    menu.style.display = "none";
                }
            });
        </script>

        </script>
    </div>
    <div class="Smanage">
        <form id="Sacc" method="post">
            <div class="info">Tài khoản:<a id="info"> <?php echo $username; ?></a></div>
            <div class="info">Tên của bạn:<a id="info"> <?php echo $Sname; ?></a></div>
            <div class="info">Ngày Sinh:<a id="info"> <?php echo $DOB; ?></a></div>
            <div class="info">Lớp:<a id="info"> <?php echo $Class; ?></a></div>
            <div class="info">Chuyên ngành:<a id="info"> <?php echo $Major; ?></a></div>
            <div class="info"><label id="oldlabel" for="old">Mật khẩu cũ của bạn:</label></div>
            <div class="info"><input id="old" type="password" name="old" placeholder="Bỏ qua nếu không thay đổi" required></div>
            <div class="info"><label id="newlabel" for="old">Mật khẩu mới của bạn:</label></div>
            <div class="info"><input id="new" type="password" name="newpass" placeholder="Nhập mật khẩu mới" required></div>
            <div class="info"><button id="cfpw">Đổi mật khẩu</button></div>
        </form>
    </div>

    <footer class="blog-footer">
        <p>This website has been built by
            <a class="contact" href="https://www.facebook.com/mhuywithlove">Minh Huy</a> and
            <a class="contact" href="https://www.facebook.com/profile.php?id=100006569745148">Kim Linh</a>.
        </p>
        <p>
            <a class="back" href="#">Back to top</a>
        </p>
    </footer>
    <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $old = $_POST["old"];
        $password = $_POST["newpass"];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("SELECT password FROM accounts WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
                $dbpassword = $row['password'];
                $stmt->close();
                if(password_verify($old, $dbpassword)){
                    $stmt = $conn->prepare("UPDATE accounts SET password = ? Where username = ?");
                    $stmt->bind_param("ss", $password,$username);
                    if ($stmt->execute()) {
                        echo '<script>alert("Đổi mật khẩu thành công!.");</script>';
                        exit;
                    } else {
                        echo '<script>alert("Đổi mật khẩu thất bại!.");</script>';
                    }
                    $stmt->close();
                } else {
                    echo '<script>alert("Mật khẩu cũ không đúng!.");</script>';
                }
        }

    }

    $conn->close();
    ?>



</body>

</html>