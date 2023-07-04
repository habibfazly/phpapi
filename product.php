<?php
      include "dbconnection.inc";
    
      $pname=$_POST["name"];

      $query="SELECT * FROM `products` WHERE `productName` like '%$pname%'";
               

      $cmd=mysqli_query($conn,$query);
      
      while($row=mysqli_fetch_row($cmd))
      {
      $id=$row[0];
   
      print("<tr>
        <td><img src='$row[9]' width='50' height='50'></td>
        <td>$row[1]</td>
        <td>$row[7]</td>
        <td>$row[2]</td>
        <td>$row[4]</td>
        <td>$row[5]</td>
        <td><a href='detail.php?code=$id'>detail</a></td>
     </tr>");
      }

?>  