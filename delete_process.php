<?php 
require('config.php');
$conn = mysqli_connect($host, $user, $password, $db);
settype($_POST['id'], "integer");
$filtered = array(
    'id'=>mysqli_real_escape_string($conn, $_POST['id']),
    'title'=>mysqli_real_escape_string($conn, $_POST['title']),
    'description'=>mysqli_real_escape_string($conn, $_POST['description'])
  );

$sql = "
DELETE 
  FROM topic
  WHERE id = {$filtered['id']}
";
$result = mysqli_query($conn, $sql);
if ($result === false) {
    echo '데이터베이스 저장 오류. 관리자에게 문의하세요.';
    error_log(mysqli_error($conn)); 
    //유저에겐 안보이고 Apache error log에만 기록되도록
    //WAMP manager > manage server > configure > error log 맨 아래
}
header('Location: /index.php'); 
?>