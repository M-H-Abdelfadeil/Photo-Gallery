$(document).ready(function(){
	$('#progress').hide();
	$('#uploadBtn').hide();
	$('form').ajaxForm({
		beforeSend:function(){
			$('#progressbar').width('0%');
			$('#textstatus').html('0%');

		},
		uploadProgress:function(event,position,total,statusComplete){
			$('#progress').show();
			$('#progressbar').width(statusComplete + '%');
			$('#textstatus').html(statusComplete +'%');
		},
		complete:function(xhr){
			fetch();
			$('#titleImg').val(null);
			$('#img').removeAttr('src');
			$('#uploadBtn').hide();
			$('#progress').hide();
			$('#response').html(xhr.responseText);

		}
	});
	$('#file').change(function(event){
		$('#uploadBtn').slideDown(500);
		img=document.getElementById('img');
		img.src=URL.createObjectURL(event.target.files[0]);
	});
	function fetch(){
        $.ajax({

          url:'fetch.php',
          type:'post',
          data:{
            fetch:'fetch'
          },
          success:function(data){
            $('#allImg').html(data);
            //console.log(data);
          }

        });
    }  
    fetch();  

    //delete 
    $(document).on('click','#deleteBtn',function(){
    	var id = $(this).attr('getId');
    	
    	if (confirm("Are you sure you want to delete it?")) {
    		$.ajax({
	    		url:'delete.php',
	              type:'post',
	              
	              data:{
	                id:id
	              },
	              success:function(data){
	                fetch();
	                $('#response').html(data);
	              }

	    	});
    	}
    	
    	
    })
      


	



})
