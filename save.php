<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "godiva_db";

$conn = new mysqli($host, $user, $password, $dbname);
if($conn->connect_error){
    die("連線失敗" . $conn->connect_error);
}
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

$sql = "INSERT INTO messages(name , email , message) VALUES(? , ? , ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);/*預防SQL INJECTION */
$stmt->execute();

echo "留言送出成功！<br>";
echo "<a href='form.html'>回到表單</a>";

$stmt->close();
$conn->close();
?>