$(document).ready(function() {
  var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
 	if(dd<10){
		dd='0'+dd
  }
  if(mm<10){
    mm='0'+mm
  }

	today = yyyy+'-'+mm+'-'+dd;
	document.getElementById("birthday").setAttribute("max", today);

    $('#LoginBtn').click(function(e) {
  	$("#LoginModal").delay(100).fadeIn(100);
  		$("#RegisterModal").fadeOut(100);
  	$('#RegisterBtn').removeClass('active');
  	$(this).addClass('active');
  	e.preventDefault();
  });
  $('#RegisterBtn').click(function(e) {
  	$("#RegisterModal").delay(100).fadeIn(100);
  		$("#LoginModal").fadeOut(100);
  	$('#LoginBtn').removeClass('active');
  	$(this).addClass('active');
  	e.preventDefault();
  });

});

function portugal(){
	var option = document.getElementById('country').value;
	if(option == 'Portugal'){
		$('#district').prop('disabled', false);
		$('#district').css("opacity","1");
		$('#county').prop('disabled', false);
		$('#county').css("opacity","1");
	}
	else{
		$('#district').prop('disabled', true);
		$('#district').css("opacity","0.2");
		$('#county').prop('disabled', true);
		$('#county').css("opacity","0.2");
	}
}

window.onload = portugal;
