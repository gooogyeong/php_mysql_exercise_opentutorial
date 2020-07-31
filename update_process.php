<?php 
//var_dump($_POST);
//array(2) { ["title"]=> string(6) "MySQL3" ["description"]=> string(11) "MySQL3 is.." }
require('config.php');
$conn = mysqli_connect($host, $user, $password, $db);
settype($_POST['id'], "integer");
/*
<?php
$foo = "5bar"; // string
$bar = true;   // boolean

settype($foo, "integer"); // $foo is now 5   (integer)
settype($bar, "string");  // $bar is now "1" (string)
?>
*/
$filtered = array(
    'id'=>mysqli_real_escape_string($conn, $_POST['id']),
    'title'=>mysqli_real_escape_string($conn, $_POST['title']),
    'description'=>mysqli_real_escape_string($conn, $_POST['description'])
  );

$sql = "
UPDATE topic
  SET
    title = '{$filtered['title']}',
    description = '{$filtered['description']}'
  WHERE
    id = {$filtered['id']}
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