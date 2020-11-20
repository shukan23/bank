<?php
  include "connection.php";
  $sql = 'SELECT * FROM trend ORDER BY tid DESC';
  $results = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Style the top navigation bar */
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
    <?php   include"top.php";   ?>

    <div class="topnav">
<a href="myweb.php">Home</a>
  <a href="custmors.php">View All Custmors</a>
  <a href="translog.php">Transaction History</a>
  <a href="#">About us</a>
  
</div>
</br>
    <h2>Transaction History</h2>

<table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Transaction ID</th>
            <th scope="col">Sender account no</th>
            <th scope="col">Reciever account no</th>
            <th scope="col">Amount</th>
            <th scope="col">Date & Time</th>
          </tr>
        </thead>
        <tbody>
            <?php   while($row = mysqli_fetch_assoc($results)){   ?>
            <tr>
                <td><?php echo $row['tid']; ?></td>
                <td><?php echo $row['sno']; ?></td>
                <td><?php echo $row['rno']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['timezo']; ?></td>
            </tr>
            <?php }?> 
        </tbody>
      </table>
</body>
</html>
<?php
    mysqli_free_result($results);
    mysqli_close($conn);
?>