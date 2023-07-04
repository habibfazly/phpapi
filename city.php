<?php
include "dbconnection.inc";

    $code=$_POST["id"];

    $query="SELECT * FROM `city` WHERE `CountryCode`='$code'";

    $cmd=mysqli_query($conn,$query);
                       
    while($row=mysqli_fetch_row($cmd))
    {
      print("<option value='$row[0]'>$row[1]</option>");
    }
                   
?>