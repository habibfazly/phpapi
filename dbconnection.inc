<?php

 $server="localhost";
 $uname="root";
 $pwd="";
 $database="ecommdb";


 $conn=mysqli_connect($server,$uname,$pwd,$database) 
 or die("Could not connect database");

?>