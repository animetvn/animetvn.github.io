<?php

include 'config.php';
ini_set('max_execution_time', 4000);



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql1="select * from tbl_category";
 $result1 = mysqli_query($conn, $sql1);

 if(mysqli_num_rows($result1) > 0)
 {

while($row1 = $result1->fetch_assoc()) {
 $linkdata= $row1["category_image"];

	
echo $image = "https://vihd.net/upload/".$linkdata;



$ch = curl_init($image);
$fp = fopen('images/'.$linkdata, 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);



  
 }
}
 else
 {

echo "<br />Not found story: ";
   die ();
}



$conn->close();

?>