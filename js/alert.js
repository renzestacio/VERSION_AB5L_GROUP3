function check(name){
	var a = document.getElementById(name);
	if(a.value === FALSE)){
		alert("Enter a valid input");
		a.focus();
	}
}

function imagealert(){
	alert("File not uploaded. Possibly too large or no file selected.");
}