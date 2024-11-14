<?php
$HOSTEL_ID=$_post['HOSTEL_ID'];
$HOSTEL_NAME=$_post['HOSTEL_NAME'];
$HOSTEL_TYPE=$_post['HOSTEL_TYPE'];
$HOSTEL_ADDRESS=$_post['HOSTEL_ADDRESS'];
$CONTACTNUMBER=$_post['CONTACTNUMBER'];
$MAIL_ID=$_post['MAIL_ID'];

if(!empty($HOSTEL_ID)||!empty($HOSTEL_NAME)||!empty($HOSTEL_TYPE)||!empty($HOSTEL_ADDRESS)||!empty($CONTACTNUMBER)||!empty($MAIL_ID))
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "college hostel";
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else
{
	$select="select HOSTEL_ID FROM hostel WHERE HOSTEL_ID = ? LIMIT 1";
	$INSERT="INSERT INTO hostel(HOSTEL_ID,HOSTEL_NAME,HOSTEL_TYPE,HOSTEL_ADDRESS,CONTACTNUMBER,MAIL_ID) VALUES(?,?,?,?,?,?)";
	
	$stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $HOSTEL_ID);
     $stmt->execute();
     $stmt->bind_result($HOSTEL_ID);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     if($rnum==0)
     {
     	$stmt->close();
     	$stmt=$conn->prepare($INSERT);
     	$stmt->bind_param("ssssss",$HOSTEL_ID,$HOSTEL_NAME,$HOSTEL_TYPE,$HOSTEL_ADDRESS,$CONTACTNUMBER,$MAIL_ID);
     	$stmt->execute();
     	echo "new record successfuly inserted";
     }
     else
     {
     	echo "some one already registered";
     }
     $stmt->close();
     $conn->close();
 }
}
else{
	echo "all are reqiured";
	die();
}
?>