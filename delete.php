<?php
include 'connDB.php';
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$qfetch=$conn->prepare("SELECT * FROM img WHERE id = '$id'");
	$qfetch->execute();
	$row = $qfetch->fetch();
	unlink('uploads/'.$row['img_name_save']);
	$qDel= $conn->prepare("DELETE FROM img WHERE id = '$id'");
	$qDel->execute();
	echo '
    	 <div class="alert alert-success alert-dismissible fade show" role="alert">
			The photo was deleted successfully
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
    	 ';

}