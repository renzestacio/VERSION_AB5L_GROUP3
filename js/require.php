<?php

echo "<script type=\"text/javascript\" src=\"js/jquery.min.js\"></script>
<script type=\"text/javascript\">
function positionadd(){
	catid=document.getElementById('cat_id').value;
	$.post(\"getposition.php\",{id: catid},function(data){
		data = parseInt(data) +1;
		posinput = document.getElementById('pos');
		posinput.setAttribute('max', data);
		posinput.value = data;
		

	});
	
}

function positionedit(){
	catid=document.getElementById('cat_id').value;
	$.post(\"getposition.php\",{id: catid},function(data){
		data = parseInt(data);
		if (data == 0 ){
			data += 1;
		}
		posinput = document.getElementById('pos');
		posinput.setAttribute('max', data);
		posinput.value = data;
		

	});
}


</script>";

?>