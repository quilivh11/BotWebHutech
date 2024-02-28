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
    $targetDir = "C:/Users/quili/Downloads/BaseProject/ImagePost/";
    $targetFile = $targetDir . basename($_FILES["uploadimg"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["uploadimg"]["tmp_name"], $targetFile)) {
            $stmt = $conn->prepare("SELECT Aid FROM admin WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $stmt->close();
                $timeEvent = $_POST['timeEVENT'];
                $Title = $_POST['Title'];
                $_Event = $_POST['_Event'];
                $content = $_POST['content'];
                $uploadimg = basename($_FILES["uploadimg"]["name"]);
                $Aid = $result->fetch_assoc()['Aid'];
                $stmt = $conn->prepare("INSERT INTO posts (PostTime, timeEVENT, Title, _EVENT, Content, Image, Aid) VALUES (now(), ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $timeEvent, $Title, $_Event, $content, $uploadimg, $Aid);
                if ($stmt->execute()) {
                    echo '<script>alert("Đăng bài thành công!");</script>';
                } else {
                    echo '<script>alert("Đăng bài thất bại!");</script>';
                }
                $stmt->close();
            } else {
                echo '<script>alert("Opps... Thử lại nhé!");</script>';
            }
        } else {
            echo "Lỗi tải ảnh lên. Vui lòng thử lại hoặc chọn ảnh khác!";
        }
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
    <title>Đăng bài viết</title>
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
            <h1>Đăng Bài Viết</h1>
            <ul>
                <li>
                    Vui lòng nhập đầy đủ và điền chính xác thông tin!
                </li>
            </ul>
            <h3 class="pb-4 mb-4 font-italic border-bottom"></h3>

        </div><!-- /.row -->
    </div>
    <div class="postsize">
        <form method="post" enctype="multipart/form-data">
            <div class="postpadding">
                <label id="combobox" for="combobox">Chọn sự kiện:</label>
                <select id="combobox" name="_Event">
                    <option value="Saigon" selected disabled>Vui lòng chọn sự kiện</option>
                    <option value="News">Tin Tức</option>
                    <option value="Event">Sự kiện sắp tới</option>
                </select>
            </div>
            <div class="postpadding">
                <label id="Events" for="Events">Tiêu đề:</label>
                <input type="text" id="Events" name="Title" placeholder="Nhập tiêu đề">
            </div>
            <div class="postpadding">
                <label id="eventday" for="eventday">Ngày diễn ra sự kiện:</label>
                <input type="datetime-local" id="timeEVENT" name="timeEVENT">
            </div>
            <div class="postpadding">
                <label id="card-text mb-auto" for="contents">Nội dung:</label>
                <textarea id="contents" name="content" placeholder="Vui lòng nhập nội dung!"></textarea>
            </div>
            <div class="postpadding">
                <label id="uploadimg" for="uploadimg">Chọn ảnh:</label>
                <input type="file" accept="image/*" name="uploadimg" id="uploadimg">
            </div>
            <button id="postbtn">Post</button>

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
</body>

</html>