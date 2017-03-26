<?php

include 'config.php';
ini_set('max_execution_time', 4000);



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql1="select * from tbl_channels";
 $result1 = mysqli_query($conn, $sql1);

 if(mysqli_num_rows($result1) > 0)
 {

while($row1 = $result1->fetch_assoc()) {
 $linkdata1= $row1["channel_thumbnail"];
$linkdata= str_replace(".jpg","",$linkdata1);
$linkdata1= $linkdata.".jpg";
	
echo $image = "https://i.ytimg.com/vi/".$linkdata."/hqdefault.jpg";



$ch = curl_init($image);
$fp = fopen('images/'.$linkdata1, 'wb');
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