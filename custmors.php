<?php
  include "connection.php";
  $sql = 'SELECT acno,cname FROM account ORDER BY acno';
  $results = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">


<body>
    <?php   include"top.php";   ?>

    <h2>CUSTMORS</h2>

<table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Index</th>
            <th scope="col">Custmor Name</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            <?php  $index=1;
               while($row = mysqli_fetch_assoc($results)){   ?>
            <tr>
                <th scope="row"><?php echo $index; $index++;  ?></th>
                <td><?php echo $row['cname']; ?></td>
                <td><button type="button" class="btn btn-warning"> <a href="select.php?id=<?php echo $row['acno'] ?>">View </a> </button></td>
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