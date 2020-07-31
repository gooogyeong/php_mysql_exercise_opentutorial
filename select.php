<?php 
echo "<h1>Select</h1>";
//터미널에서 mysql에 연결:
//mysql -hlocalhost -uroot -p 이 명령어 치고 패스워드 입력
require('config.php');
$conn = mysqli_connect($host, $user, $password, $db);
$sql = "SELECT * FROM topic LIMIT 100";
$result = mysqli_query($conn, $sql);
//var_dump($result);
//object(mysqli_result)#2 
//(5) { ["current_field"]=> int(0) 
//      ["field_count"]=> int(4)
//      ["lengths"]=> NULL
//      ["num_rows"]=> int(4)
 //     ["type"]=> int(0) }
//echo $result->num_rows; //4

//이제 가져온 데이터를 PHP에서 사용가능한 데이터로 전환해야함

//$row = mysqli_fetch_array($result);
//var_dump($row); // 총 4개의 데이터가 있는데 그중 첫번째만 담겨있다. (원래 echo랑 print()는 안되나?)
// array(8) {
//  [0]=>
//  string(1) "1"
//  ["id"]=>
//  string(1) "1"
//  [1]=>
//  string(5) "MySQL"
//  ["title"]=>
//  string(5) "MySQL"
//  [2]=>
//  string(13) "MySQL is ...."
//  ["description"]=>
//  string(13) "MySQL is ...."
//  [3]=>
//  string(19) "2020-07-30 15:40:30"
//  ["created"]=>
//  string(19) "2020-07-30 15:40:30"
//}


//print_r($rows); //var_dump()가 너무 정보가 많으니 간략히 print_r()을 쓰면 
// Array
// (
//     [0] => 1 // 값의 자릿수
//     [id] => 1 // column 명
//     [1] => MySQL
//     [title] => MySQL
//     [2] => MySQL is ....
//     [description] => MySQL is ....
//     [3] => 2020-07-30 15:40:30
//     [created] => 2020-07-30 15:40:30
// ) 이렇게 첫줄만 가져온다

//위 array를 토대로 필드별로 선택적으로 값을 가져올 수도 있다:
//print $row[0]; //1
//print $row[1]; //MySQL
//print $row['title']; //MySQL
//index를 통해서 값을 가져올 수도 있고(numeric array) 필드 이름을 통해 가져올 수도 있다(associative array)
//"The fetch_array() / mysqli_fetch_array() function fetches a result row as an associative array, a numeric array, or both."

// echo "<h1>".$row['title']."</h1>";
// echo $row['description'];

// $row = mysqli_fetch_array($result);
// echo "<h1>".$row['title']."</h1>";
// echo $row['description'];

// $row = mysqli_fetch_array($result);
// echo "<h1>".$row['title']."</h1>";
// echo $row['description'];

// $row = mysqli_fetch_array($result);
// echo "<h1>".$row['title']."</h1>";
// echo $row['description'];

while ($row = mysqli_fetch_array($result)) {
 echo "<h1>".$row['title']."</h1>";
 echo $row['description'];
}
?>