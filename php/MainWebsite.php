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
    header("Location: /html/MainWebsite.html");
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
    <title>Trang chủ</title>
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
        <div class="task">
            <a href="https://www.hutech.edu.vn/homepage/gioi-thieu-hutech/co-so-vat-chat">
                <img src="/Image/1.jpg" alt="Image 1" class="mySlides">
            </a><a href="https://www.hutech.edu.vn/ttvhnt">
                <img src="/Image/2.jpg" alt="Image 2" class="mySlides">
            </a><a href="https://www.hutech.edu.vn/ttvhnt">
                <img src="/Image/3.jpg" alt="Image 3" class="mySlides">
            </a><a href="https://www.hutech.edu.vn/thac-si-chinh-quy">
                <img src="/Image/4.jpg" alt="Image 4" class="mySlides">
            </a><a href="https://www.hutech.edu.vn/phongctsv/thi-dua/sinh-vien-tieu-bieu">
                <img src="/Image/5.jpg" alt="Image 5" class="mySlides">
            </a>
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
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">Tin Tức</strong>
                        <h3 class="Events">HUTECH xếp hạng thứ 10...</h3>
                        <div class="eventday">14/02/2024</div>
                        <p class="card-text mb-auto">Trường Đại học Công nghệ TP.HCM (HUTECH) đứng thứ 10 trong
                            18 trường đại học có thành tựu học thuật tốt nhất Việt Nam... </p>
                        <a href="/php/news.php" class="p-2">Xem thêm</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img width="200" height="250" src="/Image/rank.jpg">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success">Sự kiện sắp tới</strong>
                        <h3 class="Events">Lễ tốt nghiệp sinh viên K20</h3>
                        <div class="eventday">24/08/2024</div>
                        <p class="c_event">Thời khắc quan trọng nhất trong đời sinh viên đã điểm.Đợt tốt nghiệp tháng 9 dành cho các Tân Cử nhân,
                            Kỹ sư và Kiến trúc sư Trường Đại học...</p>
                        <a href="/php/event.php" class="p-2">Xem thêm</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img width="200" height="250" src="/Image/totnghiep.jpg">
                    </div>
                </div>
            </div>
        </div>
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
                            <li>Hitech Park Campus: Khu Công nghệ cao TP.HCM, Đường D1, P.Long Thạnh Mỹ, TP.Thủ Đức, TP.HCM</li>
                        </a>
                    </ul>
                </div>
            </div>
    </main>
    <footer class="blog-footer">
        <p>This website has been built by 
            <a class = "contact"href="https://www.facebook.com/mhuywithlove">Minh Huy</a> and 
            <a class ="contact"href="https://www.facebook.com/profile.php?id=100006569745148">Kim Linh</a>.
        </p>
        <p>
            <a class="back" href="#">Back to top</a>
        </p>
    </footer>



</body>

</html>