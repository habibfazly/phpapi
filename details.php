<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div id="detail" >
        <?php
          
           $id=$_GET["code"];
           print("Product code=$id");
        ?>
            <table>
                <tr>
                    <td><img src="" alt="" width="100" height="100"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>--</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>--</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>--</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>--</td>
                </tr>
            </table>
    
        </div>
</body>
</html>