<?php

include "connection.php";

if(isset($_POST['Transfer'])){
    $sender = $_REQUEST['sender'];
    $reciever1 = $_REQUEST['reciever'];
    $amt = $_REQUEST['amount'];
  

   
    $sql1 = "SELECT balance,cname FROM account WHERE acno= $sender ";
    $sender_balance = mysqli_query($conn,$sql1);
    $senbal = mysqli_fetch_assoc($sender_balance);

    $sql2 = "SELECT balance,cname FROM account WHERE acno= $reciever1 ";
    $reciever_balance = mysqli_query($conn,$sql2);
    $recbal = mysqli_fetch_assoc($reciever_balance);
    
    if($amt <  $senbal['balance']){
    $s = $senbal['balance']-$amt;
    $r = $recbal['balance']+$amt;

    $sql3 = "UPDATE account SET balance = $s WHERE account.acno = $sender";
    mysqli_query($conn,$sql3);

    $sql4 = "UPDATE account SET balance = $r WHERE account.acno = $reciever1";
    mysqli_query($conn,$sql4);

    $sname = $senbal['cname'];
    $rname = $recbal['cname'];
    $sql5 = "INSERT INTO `trend` (`sno`, `rno`, `amount`, `timezo`) VALUES ($sender,$reciever1 ,$amt , current_timestamp());";
    $nit = mysqli_query($conn,$sql5);
    $no_balance= 1;
    }
    else{
      $nit = 0;
      $no_balance= 0;
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .summary{
            margin: 100px 300px 300px 300px;
            background: #f0f8ff;
            padding: 23px;
            color: var(--green);
}
        .dhruv{
          margin: 100px 150 150px 150px;
            background: #f0f8ff;
            padding: 23px;
            color: var(--red);
        }
        
 .topnav {
  overflow: hidden;
  background-color: #343a40;
}

/* Style the topnav s */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

    </style>
</head>
<body>
    <?php include "top.php"; ?>
    <div class="topnav">
<a href="myweb.php">Home</a>
  <a href="custmors.php">View All Custmors</a>
  <a href="translog.php">Transaction History</a>
  <a href="#">About us</a>
  
</div>
    <div class="summary">
   
<?php if($nit && $no_balance){ ?>
  <h1>Transaction successful <b>☺</b></h1></br>
       <h3> <?php  echo "Sender Name   : ".$sname;  ?> </h3> 
       <h3>  <?php  echo "Reciever Name : ". $rname; ?> </h3> 
       <h3>  <?php   echo "Amount        : ".$amt;?></h3> 
    <?php    }
    else{
   ?> <div class="dhruv"> <h1>Transaction Failed</h1></br><?php echo "Insufficient balance or Transaction error"; ?></div>
   <?php  }
?>
  <button type="button" class="btn btn-save"> <a href="myweb.php">GO TO HOME </a> </button>
 </div>

</body>
</html>
<?php
    mysqli_free_result($sender_balance);
    mysqli_free_result($reciever_balance);
    mysqli_close($conn);
?>