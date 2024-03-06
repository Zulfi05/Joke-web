function checkusername(name) {
	let nameRegEx = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

	if (nameRegEx.test(name))
		return true;
	else
		return false;
}
function checkpassword(password) {

	let regExPosition = /^(?=.*?[a-zA-Z])(?=.*?[^\w\s]).{8,20}$/;

	if (regExPosition.test(password)) {
		//error
		return true;


	} else {
		return false;
	}
}

function verifyloginpage(event) {

	let uname = document.getElementById("username");
	let password = document.getElementById("password");
	var erpass = document.getElementById("error-text-password");
	var eruser = document.getElementById("error-text-username");
	var erpassinput = document.getElementById("password");
	var eruserinput = document.getElementById("username");
	let formIsValid = true;
	if (!checkusername(uname.value)) {
		//eruserinput.className = "inputerror";
		eruser.className = "error_msg";	
		eruser.classList.remove("error-text-hidden");
		console.log("'" + uname.value + "' is not a valid username. Username needs to be a valid Email");
		formIsValid = false;
	}	
	else{
		//eruser.classList.remove("error_msg");
		eruserinput.classList.remove("inputerror");
		eruser.classList.add("error-text-hidden");
	}
	
	
	if (!checkpassword(password.value)) {
		//erpassinput.className = "inputerror";
		erpass.className="error_msg";
		erpass.classList.remove("error-text-hidden");
		console.log("'" + password.value + "' is not a valid password. Password needs to be 8 characters long, at least one non-letter character");
		formIsValid = false;
	}
	else{
		//erpass.classList.remove("error_msg");
		erpassinput.classList.remove("inputerror");
		erpass.classList.add("error-text-hidden");
	}
	if (formIsValid === false) {
		event.preventDefault();

	}
	else {

		console.log("validation successful, sending password to the server");
	}
}
