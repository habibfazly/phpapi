<?php
   $msg="";  
   $names=""; 
   $img=""; 
   $cmd=false;
   include "dbconnection.inc";
    
   $queryn="SELECT substr(max(`productCode`),5)+1 from products";
   $cmdn=mysqli_query($conn,$queryn);
   $rown=mysqli_fetch_row($cmdn);
   $maxid=$rown[0];
   $newid="AAA-" . $maxid;


   if (isset($_FILES["uploaded_file"]))
   {
      //-----------START FILE UPLOAD-----------------------
      $count=count($_FILES['uploaded_file']['name']);

      $msg="Total no. of selected product files=" . $count;
      $upload_folder = './data/'; //<-- this folder must be writeable by the script
      $code=$_POST["code"];

      for ($i=0; $i<$count; $i++)
      {


         //Get the uploaded file information
         $name_of_uploaded_file =  basename($_FILES['uploaded_file']['name'][$i]);
	   

         //copy the temp. uploaded file to uploads folder
		 $path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;

		 $tmp_path = $_FILES["uploaded_file"]["tmp_name"][$i];

         copy($tmp_path,$path_of_uploaded_file);
        
         $names .=  $name_of_uploaded_file;

         $msg="Your all products images has been uploaded";

         if($i==0)
         {
            $img=$path_of_uploaded_file;
         }

         //-------------------INSERT DB IMAGES-------------
            $query2="INSERT INTO `productimages` (`id`, `name`, `code`) VALUES (NULL, '$path_of_uploaded_file', '$code')";

            $cmd2=mysqli_query($conn,$query2);

         //-------------------------------------------------
      }
     //-------------END FILE UPLOAD------------------------

     //-------------START DB TRANSACTION-------------------
     
     $name=$_POST["name"];
     $desc=$_POST["desc"];
     $price=$_POST["price"];
     

     $query="INSERT INTO `products` (`productCode`, `productName`, `productLine`, `productScale`, `productVendor`, `productDescription`, `quantityInStock`, `buyPrice`, `MSRP`, `image`) VALUES ('$code', '$name', NULL, NULL, NULL, '$desc', NULL, '$price', NULL, '$img')";

     $cmd=mysqli_query($conn,$query);
    
     $msg="Your all products images has been uploaded and saved";

     //------------------END DB TRANSACTION---------------------
   }
   else
   {
    $msg="Please select your products images";
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Upload Product</h1>
    <h2>
        <?php
           print("$msg");
           //print("$names");
        ?>
    </h2>
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Enter Product Code</td>
                <td><input type="text" name="code" value=<?php print("$newid"); ?>></td>
            </tr>
            <tr>
                <td>Enter Product Name</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Enter Product Description</td>
                <td><input type="text" name="desc"></td>
            </tr>
            <tr>
                <td>Enter Product Price</td>
                <td><input type="text" name="price"></td>
            </tr>
            <tr>
                <td>Select Product Images</td>
                <td><input type="file" name="uploaded_file[]" multiple="multiple" id=""></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="submit"></td>
            </tr>
        </table>
    </form>
</body>
</html>