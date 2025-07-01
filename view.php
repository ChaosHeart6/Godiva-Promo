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
$total = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>留言列表</title>
    <style>
    body {
      font-family: "Segoe UI", sans-serif;
      padding: 30px;
      background: #f3f3f3;
    }
    h2 { color: #444; }
    .count {
      font-size: 1rem;
      color: #666;
      margin-bottom: 10px;
    }
    .card {
      background: #fff;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.12);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
      transform: scale(1.02);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .email {
      color: #777;
      font-size: 0.9em;
    }
    .date {
      color: #aaa;
      font-size: 0.8em;
      margin-top: 5px;
    }
    p {
      white-space: pre-wrap;
      line-height: 1.5;
      margin: 10px 0;
    }
  </style>
</head>
<body>
  <h2>💬 留言列表</h2>
  <a href="index.html">← 回到活動網頁</a>
  <div class = "count">目前共有 <?=$total?>筆留言</div>
  <hr><br>
  
  <?php
  if ($total > 0) {
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