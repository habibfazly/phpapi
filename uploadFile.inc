<?php

   //Settings 

    $max_allowed_file_size = 4000; // size in KB 
    $allowed_extensions = array("xlsx","pdf","docx");
    $upload_folder = './upload/'; //<-- this folder must be writeable by the script
    $errors ='';

	  //Get the uploaded file information
	  $name_of_uploaded_file =  basename($_FILES['uploaded_file']['name']);
	
	    //get the file extension of the file
	    $type_of_uploaded_file = substr($name_of_uploaded_file, strrpos($name_of_uploaded_file, '.') + 1);
	
	    $size_of_uploaded_file = $_FILES["uploaded_file"]["size"]/1024;
	
	    //------------Do Validations-------------
      
	    if($size_of_uploaded_file > $max_allowed_file_size ) 
	    {
		    $errors = "\n Size of file should be less than $max_allowed_file_size";
	    }
	
	    //------ Validate the file extension -----
	    $allowed_ext = false;
      
	    for($i=0; $i<sizeof($allowed_extensions); $i++) 
	    { 
		    if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
		    {
			    $allowed_ext = true;		
		    }
	    }
	
	    if(!$allowed_ext)
	    {
		    $errors = "The uploaded file is not supported ";
	    }
	
	    //Upload File 
	    if(empty($errors))
	    {
		    //copy the temp. uploaded file to uploads folder
		    $path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;

		    $tmp_path = $_FILES["uploaded_file"]["tmp_name"];
		
		    copy($tmp_path,$path_of_uploaded_file);
		} 
        else
        {
               $errors ='File has been uploaded';
        }
 		    
	  	
  
 ?>