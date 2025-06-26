<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "godiva_db";

$conn = new mysqli($host, $user, $password, $dbname);
if($conn->connect_error){
    die("連線失敗：" . $conn->connect_error);
}

$sql = "SELECT * FROM messages ORDER BY create_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>留言列表</title>
  <style>
    body { font-family: Arial; padding: 20px; background: #f9f9f9; }
    h2 { color: #444; }
    .card {
      background: #fff;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .card .email { color: #555; font-size: 0.9em; }
    .card .date { color: #aaa; font-size: 0.8em; margin-top: 5px; }
  </style>
</head>
<body>
  <h2>💬 留言列表</h2>
  <a href="form.html">← 回留言表單</a>
  <hr><br>
  
  <?php
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<div class='card'>";
          echo "<strong>" . htmlspecialchars($row["name"]) . "</strong> ";
          echo "<span class='email'>（" . htmlspecialchars($row["email"]) . "）</span><br>";
          echo "<p>" . nl2br(htmlspecialchars($row["message"])) . "</p>";
          echo "<div class='date'>" . $row["create_at"] . "</div>";
          echo "</div>";
      }
  } else {
      echo "目前尚無留言。";
  }
  $conn->close();
  ?>
</body>
</html>