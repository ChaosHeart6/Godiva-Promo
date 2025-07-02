<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";

$conn = new mysqli($host, $user, $password, $dbname);
if($conn->connect_error){
    die("連線失敗：" . $conn->connect_error);
}

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);
if (!$result) {
    die("SQL 錯誤：" . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>留言列表</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1 style = "text-align: center;">GODIVA 留言版</h1>
  <div class = "container">
    <?php
  if ($result->num_rows > 0) {/*資料顯示*/ 
      while($row = $result->fetch_assoc()) {
          echo "<div class='card'>";
          echo "<strong>" . htmlspecialchars($row["name"]) . "</strong> ";/*預防XSS*/
          echo "<span class='email'>（" . htmlspecialchars($row["email"]) . "）</span><br>";
          echo "<p>" . nl2br(htmlspecialchars($row["message"])) . "</p>";
          echo "<div class='date'>" . $row["created_at"] . "</div>";
          echo "</div>";
      }
  } else {
      echo "目前尚無留言。";
    }
    $conn->close();
    ?>
  </div>
  <div class = "link">
    <a href="form.html">回到留言表單</a>
    <a href="index.html">返回活動頁面</a>
  </div>
  <hr><br>
</body>
</html>