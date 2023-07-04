<?php
 include "dbconnection.inc";
 $pname="";

 if (isset($_GET["pname"]))
 {
    $pname=$_GET["pname"];
 }

 $cat="";

 if (isset($_GET["cat"]))
 {
    $cat=$_GET["cat"];
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="JS/code.jquery.com_jquery-2.1.1.min.js" type="text/javascript"></script>

     <script>
      function search()
      {
        var name=document.getElementById("pname").value;
        var cat=document.getElementById("cat").value;

        alert("Product Name"+name);

        var dataString = 'name=' + name;

$.ajax ({
    type: "POST",
    url: "product.php",
    data: dataString,
    cache: false,
    success: function (html)
     {
        $(".tblsearch").html(html);
     }
    });
      }

     </script>

</head>
<body>
    <form action="" >
    <table>
        <tr>
            <td>Enter Product Name</td>
            <td><input type="text" name="pname" id="pname"></td>
        </tr>
        <tr>
            <td>Select Category</td>
            <td>
                <select name="cat" id="cat">
                    <option value="">Please Select Category</option>
                    
                    <?php
                      $query="SELECT * FROM `productlines`";
                      $cmd=mysqli_query($conn,$query);
                      
                      while($row=mysqli_fetch_row($cmd))
                      {
                        print("<option>$row[0]</option>");
                      }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="button" value="Search" onclick="search()"></td>
        </tr>
    </table>
   </form>

   <table class="tblsearch">
       <tr>
          <td>Image</td>
          <td>Name</td>
          <td>Unit Price</td>
          <td>Category</td>
          <td>Vendor</td>
          <td>Detail</td>
          <td>Click for detail</td>
       </tr>
   
    </table>

</body>
</html>