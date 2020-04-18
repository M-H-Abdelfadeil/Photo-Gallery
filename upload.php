<?php

include 'connDB.php';




if (isset($_FILES['pic'])) {
	$path='uploads/';
	$title=filter_var($_POST['titleImg'],FILTER_SANITIZE_STRING);
    $file             =$_FILES['pic'];
    $file_name        =$file['name'];
    $file_tmp_name    =$file['tmp_name'];
    $size             =$file['size'];
    $error   		  =$file['error'];
    $errMessage = array();
    $allowExtensions=array('png','jpg','jpeg');
    $extension = explode('.',$file_name);
    $extension = strtolower(end($extension));
    $nameSave=time().uniqid().rand(0,100000265436767469).'.'.$extension;
	if (strlen($title)>20 || strlen($title) < 4 ) {
		$errMessage[]= "The title of the image cannot be greater than 20 characters or greater than 4";
	}
    if ($error == 0 ) {
    	if (!in_array( $extension, $allowExtensions)) {
    		$errMessage[]= "This file is not supported";
    	}else{
    		if ($size > 5242880) {
    			$errMessage[]= "The maximum file size is 5 MB";
    		}
    	}
    }
    if (!empty($errMessage)) {
    	
    		echo '
    		<div class="alert alert-danger alert-dismissible fade show" role="alert">';
			  foreach ($errMessage as $Msg) {
			  		echo $Msg . '<br>';
			  }
			  echo'
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
    		';
    }else{
    	 move_uploaded_file($file_tmp_name,$path.$nameSave);
    	 $qIns = $conn->prepare("INSERT INTO img (title,img_name,img_name_save) 
    	 						VALUES ('$title','$file_name','$nameSave')");
    	 $qIns->execute();
    	 echo '
    	 <div class=" alert alert-success alert-dismissible fade show" role="alert">
			The photo ['.$file_name.'] was uploaded successfully
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
    	 ';

    }

    /*        
   
	*/
}else{
    echo "Error";
}
