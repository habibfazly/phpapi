<?php
    include "dbconnection.inc";
    $cmd=false;
    $msg="";
    $name="";
    $email="";
    session_start();

    if (isset($_POST["name"]))
    {
        $name=$_POST["name"];
        $email=$_POST["email"];
        $pwd=md5($_POST["pwd"]);
        $code=$_POST["code"];
        $scode=$_SESSION["security_code"];
       

        $upload_folder = './upload/';
         //Get the uploaded file information
	    $name_of_uploaded_file =  basename($_FILES['uploaded_file']['name']);
	    //copy the temp. uploaded file to uploads folder
         $path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;

         $file=$path_of_uploaded_file;

    if ($code==$scode)
    {
        //check email id
        $q1="SELECT count(*) FROM `customers` WHERE `email` LIKE '$email'";
        $c=mysqli_query($conn,$q1);
        $r=mysqli_fetch_row($c);

        $noorec=$r[0];

        if ($noorec>0)
        {
            $msg="Email ID already exsist plz choose different";
        }
        else
        {
        //insert record
        $query="INSERT INTO `customers` (`customerNumber`, `customerName`, `contactLastName`, `contactFirstName`, `phone`, `addressLine1`, `addressLine2`, `city`, `state`, `postalCode`, `country`, `salesRepEmployeeNumber`, `creditLimit`, `email`, `pwd`,file) VALUES (NULL, '$name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$email', '$pwd','$file')";

        $cmd=mysqli_query($conn,$query);

        include "uploadFile.inc";

        header("Location: thanks.php");
        }
    }
    else
    {
        $msg="Invalid captcha code please try again";
    }
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
        function referesh()
        {
            $("#captcha").attr("src","CaptchaImages.php");
        }

        function cityData(id)
        {
         var dataString = 'id=' + id;

				$.ajax ({
						type: "POST",
						url: "city.php",
						data: dataString,
						cache: false,
						success: function (html)
						 {
								$(".city").html(html);
						 }
						});

        }
    </script>
</head>
<body>
    <h1>
        <?php
           if ($cmd==true)
           {
            print("Your registration has been completed plz sign in");
           }

           print("$msg");
        ?>
    </h1>
<form method="POST" action="" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Enter Name</td>
            <td><input type="text" name="name" value="<?php print("$name"); ?>" required></td>
        </tr>
        <tr>
            <td>Enter Email</td>
            <td><input type="email" name="email" value="<?php print("$email") ?>" required></td>
        </tr>
        <tr>
            <td>Enter Password</td>
            <td><input type="password" name="pwd" required></td>
        </tr>
        <tr>
            <td>Enter Confirm Password</td>
            <td><input type="password" name="cpwd" required></td>
        </tr>
        <tr>
            <td>Select Country</td>
            <td>
                <select name="country" id="" onchange="cityData(this.value)">
                    <?php
                       $query="select * from country";
                       $cmd=mysqli_query($conn,$query);
                       
                       while($row=mysqli_fetch_row($cmd))
                       {
                       print("<option value='$row[0]'>$row[1]</option>");
                       }
                   ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Select City</td>
            <td>
                <select name="city" class="city">
              
                </select>
            </td>
        </tr>
        <tr>
            <td>Enter Address</td>
            <td>
               <textarea name="address" id="" cols="30" rows="10"></textarea>
            </td>

        </tr>
        <tr>
            <td>upload your resume</td>
            <td>
               <input type="file" name="uploaded_file" id="">
            </td>
        </tr>
        <tr>
            <td>Enter Code</td>
            <td>
              <input type="text" name="code">
            </td>
        </tr>
        <tr>
            <td>Captcha</td>
            <td>
             <img id="captcha" src="CaptchaImages.php" alt="" width="300px" height="100px">
             <input type="button" value="referesh" onclick="referesh()">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
              <input type="submit" value="submit">
            </td>
        </tr>

    </table>
</form>
</body>
</html>