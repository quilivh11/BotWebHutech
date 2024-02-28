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
// Truy vấn dữ liệu từ cơ sở dữ liệu
$sql = "SELECT * FROM posts WHERE _Event = 'Event'";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/Image/icon.png ">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.72.0">
    <title>Sự kiện</title>
    <link rel="stylesheet" href="/css/MainWebsite.css">
    <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/blog/">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>



    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->

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
            var slideIndex = 0;
            showSlides();

            function showSlides() {
                var i;
                var slides = document.querySelectorAll('.mySlides');
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slideIndex++;
                if (slideIndex > slides.length) {
                    slideIndex = 1;
                }
                slides[slideIndex - 1].style.display = "block";
                setTimeout(showSlides, 3000);
            }
        </script>
        <div class="container" id="padevent">
            <h1 class="newstt">Sự kiện</h1>
            <?php
            if ($result->num_rows > 0) {
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $rows = array_reverse($rows);
                foreach ($rows as $row) {
                    echo "<div class='padevent2'>";
                    echo "<div class='padevent'>";
                    echo "<p>Thời gian diễn ra " . $row["TimeEVENT"] . "</p>";
                    echo "<h2 class='ttnews'>" . $row["Title"] . "</h2>";
                    echo "<p>" . $row["Content"] . "</p>";
                    echo "<div class='imgsize'><img  src='/ImagePost/" . $row["Image"] . "' alt='Post Image'></div>";
                    echo "<p>Đã đăng lúc: " . $row["PostTime"] . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "Không có bài viết nào.";
            }
            $conn->close();
            ?>

        </div>
        <main class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="pb-4 mb-4 font-italic border-bottom">
                    </h3>

                    <div class="blog-post">
                        <h2 class="blog-post-title">TRƯỜNG ĐẠI HỌC CÔNG NGHỆ TP.HCM</br>
                            HUTECH UNIVERSITY</h2></br>
                        <ul>
                            <a class="addr" href="https://maps.app.goo.gl/59bEscorNPNHXXv36">
                                <li>Saigon Campus: 475A Điện Biên Phủ, P.25, Q.Bình Thạnh, TP.HCM</li>
                            </a><a class="addr" href="https://maps.app.goo.gl/cjnqhm5kBrH3ZEhQ7">
                                <li>Ung Van Khiem Campus: 31/36 Ung Văn Khiêm, P.25, Q.Bình Thạnh, TP.HCM</li>
                            </a><a class="addr" href="https://maps.app.goo.gl/QyLtVLcJymURwj156">
                                <li>Thu Duc Campus: Khu Công nghệ cao TP.HCM, Xa lộ Hà Nội, P.Hiệp Phú, TP.Thủ Đức, TP.HCM</li>
                            </a><a class="addr" href="https://maps.app.goo.gl/Q4MQJdKemfuEuRkYA">
                                <li>Hutech Park Campus: Khu Công nghệ cao TP.HCM, Đường D1, P.Long Thạnh Mỹ, TP.Thủ Đức, TP.HCM</li>
                            </a>
                        </ul>
                    </div>
                </div>
        </main>
    </div>
    <footer class="blog-footer">
        <p>This website had built by
            <a class="contact" href="https://www.facebook.com/mhuywithlove">Minh Huy</a> and
            <a class="contact" href="https://www.facebook.com/profile.php?id=100006569745148">Kim Linh</a>.
        </p>
        <p>
            <a class="back" href="/#">Back to top</a>
        </p>
    </footer>
</body>

</html>