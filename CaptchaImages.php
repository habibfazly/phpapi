<?php

//Start the session so we can store what the security code actually is
session_start();

          $IMAGE_WIDTH = 400;
          $IMAGE_HEIGHT = 100;
          $characters =5;
          $font = 'font/teen spirit.ttf';
          $security_code =generateCode($characters);
 
          //Set the session to store the security code
           $_SESSION["security_code"] = $security_code;
    
          /* font size will be 75% of the image height */
          $font_size = 50;
        
          $image = imagecreate($IMAGE_WIDTH, $IMAGE_HEIGHT)
                                     or die("Could not create image");

        
          $text_color =imagecolorallocate($image, 20, 40, 100);
    
          //We are making three colors, white, black and gray 
          $white = ImageColorAllocate($image, 255, 255, 255); 
          $black = ImageColorAllocate($image, 0, 0, 0); 
          $grey = ImageColorAllocate($image, 204, 204, 204); 

          //Make the background grey 
          ImageFill($image, 0, 0, $grey); 
    
          
          imagettftext($image, $font_size, 0, 75, 75, $text_color, $font , $security_code)
                                  or die('Error in imagettftextfunction');
      
          //Throw in some lines to make it a little bit harder for any bots to break 
          
          ImageRectangle($image,0,0,$IMAGE_WIDTH-1,$IMAGE_HEIGHT-1,$black); 
          
          imageline($image, 0, $IMAGE_HEIGHT/2, $IMAGE_WIDTH, $IMAGE_HEIGHT/2, $black); 
          
          imageline($image, $IMAGE_WIDTH/2, 0, $IMAGE_WIDTH/2, $IMAGE_HEIGHT, $black); 
 
          header("Content-type: image/png");
          imagepng($image);
          imagedestroy($image);

          function generateCode($characters)
             {
                /* list all possible characters, similar looking characters and vowels have been removed */
                $possible = '2456789ABCDEFGHIJKLMNPQRSTUVW';
                $code = '';
                $i = 0;
        
                while ($i < $characters)
                {
                    $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
                    $i++;
                }
                return $code;
             }


?>