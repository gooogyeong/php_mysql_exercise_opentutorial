<?php 
//var_dump($_POST);
//array(2) { ["title"]=> string(6) "MySQL3" ["description"]=> string(11) "MySQL3 is.." }
require('config.php');
$conn = mysqli_connect($host, $user, $password, $db);
$filtered = array(
    'name'=>mysqli_real_escape_string($conn, $_POST['name']),
    'profile'=>mysqli_real_escape_string($conn, $_POST['profile']),
  );
$sql = "
INSERT INTO author
    (name, profile)
    VALUES(
        '{$filtered['name']}',
        '{$filtered['profile']}'
    )
";
//echo $sql;
$result = mysqli_query($conn, $sql);
if ($result === false) {
    echo '데이터베이스 저장 오류. 관리자에게 문의하세요.';
    error_log(mysqli_error($conn)); 
    //유저에겐 안보이고 Apache error log에만 기록되도록
    //WAMP manager > manage server > configure > error log 맨 아래
}
header('Location: /author.php'); 
?>