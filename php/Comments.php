<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "sqlclient";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $stmt = $conn->prepare("SELECT Sid FROM student WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $Sid = $result->fetch_assoc()['Sid'];
        $stmt->close();

        $Uname = $_POST['Uname'];
        $Email = $_POST['Email'];
        $Phone = $_POST['Phone'];
        $Fbcontent = $_POST['Fbcontent'];

        $stmt = $conn->prepare("INSERT INTO feedbacks (Uname, Email, Phone, Fbcontent, Sid) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $Uname, $Email, $Phone, $Fbcontent, $Sid);

        if ($stmt->execute()) {
            echo '<script>alert("Đã gửi!");</script>';
        } else {
            echo '<script>alert("Gửi thất bại. Vui lòng thử lại! ' . $stmt->error . '");</script>';
        }

        $stmt->close();
    } else {
        echo '<script>alert("Opps... Thử lại nhé!");</script>';
    }
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
    <title>Góp  ý</title>
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

    </div>

    <div class="container">
        <div class="row">
            <h1>Đóng góp ý kiến</h1>
            <ul>
                <li> Đây là kênh thông tin tiếp nhận những góp ý, chia sẻ, thắc mắc của tất cả phụ huynh, sinh viên, giảng viên,
                    cán bộ nhân viên và tất cả những ai quan tâm gửi ý kiến đóng góp cho Nhà trường. Các câu hỏi, góp ý gửi đến
                    sẽ hoàn toàn được giữ bí mật và được Hội Đồng Quản Trị, Ban Giám Hiệu, các trưởng bộ phận trả lời sớm nhất.
                    Chân thành cảm ơn bạn đã có những ý kiến đóng góp xây dựng và phát triển Trường .</li>
                <li>
                    Chú ý : Để nhận được câu trả lời của Nhà trường xin vui lòng nhập địa chỉ Email chính xác
                </li>
            </ul>
            <h3 class="pb-4 mb-4 font-italic border-bottom"></h3>

        </div>
    </div>
    <div class="postsize">
        <form method="post">
            <div class="container">
                <label id="fname" for="FullName">Họ và tên:</label>
                <input type="text" id="FullName" name="Uname" required>
                <label id="fname" for="Phone">Số Điện Thoại:</label>
                <input type="tel" id="Phone" name="Phone" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10" required>
                <label id="fname" for="email"> Email:</label>
                <input type="email" id="email" name="Email" required>
                <div class="postpadding">
                    <label id="card-text mb-auto" for="contents">Nội dung:</label>
                    <textarea id="contents" name="Fbcontent" placeholder="Vui lòng nhập nội dung!"></textarea>
                </div>
                <button id="postbtn">Gửi</button>
            </div>
        </form>
    </div>
    </main>
    <footer class="blog-footer">
        <p>This website has been built by
            <a class="contact" href="https://www.facebook.com/mhuywithlove">Minh Huy</a> and
            <a class="contact" href="https://www.facebook.com/profile.php?id=100006569745148">Kim Linh</a>.
        </p>
        <p>
            <a class="back" href="#">Back to top</a>
        </p>
    </footer>



</body>

</html>