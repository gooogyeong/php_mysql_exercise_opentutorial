<?php 
require('config.php');
$conn = mysqli_connect($host, $user, $password, $db);
$filtered_id =mysqli_real_escape_string($conn, $_POST['id']);
$sql = "
    DELETE 
      FROM topic
      WHERE
        author_id = '{$filtered_id}'
";
//echo $sql;
$result = mysqli_query($conn, $sql);
$sql = "
    DELETE 
      FROM author
      WHERE
        id = '{$filtered_id}'
";
//echo $sql;
$result = mysqli_query($conn, $sql);
if ($result === false) {
    echo '데이터 삭제 오류. 관리자에게 문의하세요.';
    error_log(mysqli_error($conn)); 
    //유저에겐 안보이고 Apache error log에만 기록되도록
    //WAMP manager > manage server > configure > error log 맨 아래
}
header('Location: /author.php'); 
?>