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
    <title>HUTECH</title>
    <link rel="stylesheet" href="/css/MainWebsite.css">
    <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/blog/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a href="/php/AdminPage.php">
                    <img class="link-secondary" src="/Image/LOGO_HUTECH.png" width="300px">
                </a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-light" href="/php/AdminPage.php">HUTECH UNIVERSITY</a>
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
            <div id="fonttext" class="menuButton">
                <button id="menuBtn"><a id="item">|||</a></button>
                <div class="menu" id="menu" style="display: none;">
                    <a id="utitle">Xin chào, <?php echo $name; ?>!</a>
                    <a href="/php/Amanage.php" class="textdecor">
                        <option>Quản lý tài khoản</option>
                    </a>
                    <a href="/php/post.php" class="textdecor">
                        <option>Đăng bài viết</option>
                    </a>
                    <a href="/php/managecomment.php" class="textdecor">
                        <option>Góp ý của sinh viên</option>
                    </a>
                    <a href="/php/Account.php" class="textdecor">
                        <option>Đăng xuất</option>
                    </a>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Hiển thị hoặc ẩn menu khi click vào nút "|||"
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
                // Clicked outside the menu button and menu
                menu.style.display = "none";
            }
        });
    </script>


</body>

</html>