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
$stmt = $conn->prepare("SELECT username FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows <= 0) {
    header("Location: /php/account.php");
    exit();

}

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require 'C:/Users/quili/Downloads/BaseProject/vendor/autoload.php';

function generateRandomPassword($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("SELECT Aid FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $Aid = $result->fetch_assoc()['Aid'];
        $stmt->close();
        $fileName = $_FILES['import_file']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowed_ext = ['xls', 'csv', 'xlsx'];
        if (in_array(strtolower($file_ext), $allowed_ext)) {
            $inputFileNamePath = $_FILES['import_file']['tmp_name'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();
            $count = "0";
            foreach ($data as $row) {
                if ($count > 0) {
                    $SID = $row['0'];
                    $Sname = $row['1'];
                    $DOB = $row['2'];
                    $Class = $row['3'];
                    $Major = $row['4'];
                    $Uid = $row['5'];
                    $checkStmt = $conn->prepare("SELECT username FROM accounts WHERE username = ?");
                    $checkStmt->bind_param("s", $SID);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();
                    if ($checkResult->num_rows > 0) {
                        $updateStudentStmt = $conn->prepare("UPDATE student SET SName=?, DOB=?, Class=?, Major=? WHERE Sid=? AND Aid=?");
                        $updateStudentStmt->bind_param("ssssss", $Sname, $DOB, $Class, $Major, $SID, $Aid);
                        if ($updateStudentStmt->execute()) {
                            $msg = true;
                        } else {
                            echo '<script>alert("Update thất bại. Vui lòng thử lại!");</script>';
                        }
                        $updateStudentStmt->close();
                    } else {
                        $PID = $SID;
                        $password = $SID;
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $insertAccountStmt = $conn->prepare("INSERT INTO accounts (username, password) VALUES (?, ?)");
                        $insertAccountStmt->bind_param("ss", $SID, $password);
                        if ($insertAccountStmt->execute()) {
                            $insertStudentStmt = $conn->prepare("INSERT INTO student (Sid, SName, DOB, Class, Major, username, Aid) VALUES (?, ?, ?, ?, ?, ?, ?)");
                            $insertStudentStmt->bind_param("sssssss", $SID, $Sname, $DOB, $Class, $Major, $Uid, $Aid);
                            if ($insertStudentStmt->execute()) {
                                $msg = true;
                            }
                            $insertStudentStmt->close();
                        } else {
                            echo '<script>alert("Dữ liệu của Sinh viên ' . $SID . ' đã tồn tại trong hệ thống!");</script>';
                        }
                        $insertAccountStmt->close();
                    }
                } else {
                    $count = "1";
                }
            }
            if (isset($msg)) {
                echo '<script>alert("Cập nhật dữ liệu thành công!");</script>';
            } else {
                echo '<script>alert("Cập nhật dữ liệu thất bại!");</script>';
            }
        } else {
            echo '<script>alert("Lỗi thêm file. Vui lòng thử lại!");</script>';
        }
    } else {
        echo '<script>alert("Vui lòng đăng nhập trước!");</script>';
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
    <title>Chọn file</title>
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
                    <a href="/html/Comments.html" class="textdecor">
                        <option>Góp ý của sinh viên</option>
                    </a>
                    <a href="/php/Account.php" class="textdecor">
                        <option>Đăng xuất</option>
                    </a>
                    </a>
                </div>
            </div>
        </div>
        <div class="Addstu">
            <form id="Sacc2" method="post" enctype="multipart/form-data">
                <label for="excel">Chọn file:</label>
                <input type="file" accept=".xlsx, .xls" name="import_file">
                <div class="info2"><button id="cfpw2">Thêm</button></div>

            </form>
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
</body>

</html>