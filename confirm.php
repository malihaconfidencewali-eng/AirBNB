<?php include 'db.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $property_id=$_POST['property_id'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $checkin=$_POST['checkin'];
  $checkout=$_POST['checkout'];

  $stmt=$conn->prepare("INSERT INTO bookings (property_id,name,email,checkin,checkout) VALUES (?,?,?,?,?)");
  $stmt->execute([$property_id,$name,$email,$checkin,$checkout]);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Booking Confirmed</title>
<style>
body{font-family:Arial;background:#f9f9f9;text-align:center;margin-top:50px;}
.box{background:#fff;padding:30px;display:inline-block;
box-shadow:0 4px 10px rgba(0,0,0,0.1);border-radius:10px;}
h1{color:#ff5a5f;}
</style>
</head>
<body>
<div class="box">
  <h1>Booking Confirmed!</h1>
  <p>Thank you for booking. We’ve sent a confirmation email.</p>
  <button onclick="window.location.href='index.php'">Go Home</button>
</div>
</body>
</html>
