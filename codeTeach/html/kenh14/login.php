<?php
session_start();
if (!empty($_SESSION['login']) && !empty($_SESSION['start'])) {
    if ($_SESSION['start'] < time() - 60) {
        session_destroy();
    } else {
        echo 'Da dang nhap truoc do';
        exit();
    }
}

$email = $_POST['email'];
$password = $_POST['password'];
if (empty($email) && empty($password)) {
?>
<form method="post" action="/login.php">
    <input name="email"><br>
    <input name="password"><br>
    <input type="submit" value="Login">
</form>
<?php exit();
}

$password = md5($password);
// Create connection
$conn = new mysqli("localhost", "root", "123456", "demo");

// Check connection
if ($conn->connect_error) {
    echo("Connection failed: " . $conn->connect_error);
} else {
    $conn->set_charset("utf8");
    $sql = "SELECT * FROM users where email='".$email."' AND password='".$password."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo 'Dang nhap thanh cong';
        $_SESSION['login'] = "success";
        $_SESSION['start'] = time();
    } else {
        echo 'User not found';
    }
}
?>