<?php
include "connection.php";


if(isset($_GET['id'])){
  
  $id = mysqli_real_escape_string($conn,$_GET['id']);
  $main1 = "SELECT * FROM account WHERE acno = $id";
  $result = mysqli_query($conn,$main1);
  $sel = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  
}
$sql = 'SELECT acno,cname FROM account ORDER BY acno';
$results = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
  .dev{
    border: solid;
    border-color : red;
    padding: 15px;
    max-width : 50%;
    margin: auto;
  }
  select{
    max-width:100%;
  } 
</style>
</head>
<body>
   
<?php   include "top.php"; ?>

<h2>Custmor Details</h2>
<table class="table" border="3">
  <thead class="thead-dark">
    <tr>
       <th scope="col">Account No</th>
        <th scope="col">Name</th>
        <th scope="col">email</th>
            <th scope="col">Balance</th>
          </tr>
        </thead>
        <tbody>
    
        <tr>
            <th scope="row"><?php echo $sel['acno']; ?></th>
            <td><?php echo $sel['cname']; ?></td>
            <td><?php echo $sel['email']; ?></td>
            <td><?php echo $sel['balance']; ?></td>
         </tr> 
        </tbody>
 </table>

<div class="dev">
<form action="trans.php" method="POST">
  
<h4><b>Transfer from : </b></h4><select name="sender">
 <option value=<?php echo $sel['acno'];  ?>><?php echo $sel['cname']; ?></option>
    </select>
    </br>
    </br>
    <h4><b>Transfer to :</b></h4>
    <select name="reciever">
    <?php while($row1 = mysqli_fetch_assoc($results)){  
      if($sel['acno'] != $row1['acno']){ ?>
        <option value= <?php echo $row1['acno'] ?>><?php echo $row1['cname']; ?></option>
    <?php }}?>
    </select>
    </br>
    </br>
    <h4><b>Amount : </b></h4> <input type="number" name="amount">
    </br>
    </br>

    <input type="submit" name="Transfer">
</form>

</div>

</body>
</html>
<?php
    mysqli_free_result($results);
    mysqli_close($conn);
?>