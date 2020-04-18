<?php

include 'connDB.php';

$qfetch=$conn->prepare("SELECT * FROM img");
$qfetch->execute();

$rows = $qfetch->fetchAll(PDO::FETCH_ASSOC);
	echo '<div class="row justify-content-center">';
	foreach ($rows as $row) {
		echo '
		
			<div class="card col-3 bg-dark text-light ml-2 mt-5" style="width: 18rem;">
				<div class="row mt-1 mb-3">
					<div class="col-7 ">
						<h6>'. $row['title'].'</h6>
					</div>
					<div class="col-4">
					<button id="deleteBtn" getId="'.$row['id'].'"  class="btn btn-danger">delete</button>
					</div>
				</div>
				<img src="uploads/'.$row['img_name_save'].'" class="card-img-top mb-3" alt="...">
			 
			</div>
		

		';
	}
	echo '</div>';
?>



