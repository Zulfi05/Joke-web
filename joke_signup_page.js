function checkusername(name) {
	let nameRegEx = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

	if (nameRegEx.test(name))
		return true;
	else
		return false;
}
function checkpassword(password) {

	let regExPosition =/^(?=.*?[a-zA-Z])(?=.*?[^\w\s]).{8,20}$/;

	if (regExPosition.test(password)) {
		return true;
	} else {
		return false;
	}
}
function checkname(name) {
	let nameRegEx = /^[a-zA-Z]+$/;

	if (nameRegEx.test(name))
		return true;
	else
		return false;
}
function checkavatar(avatar) {
	let avatarRegEx = /^[^\n]+\.[a-zA-Z]{3,4}$/;

	if (avatarRegEx.test(avatar))
		return true;
	else
		return false;
}
function checkdob(dob) {
	let dobRegEx = /^\d{4}[-]\d{2}[-]\d{2}$/;

	if (dobRegEx.test(dob))
		return true;
	else
		return false;
}
function verifysignup(event) {

	let uname = document.getElementById("username");
	var erpass = document.getElementById("error-text-password");
	var eruser = document.getElementById("error-text-username");
	let formIsValid = true;
	if (!checkusername(uname.value)) {
		//uname.className = "inputerror";
		eruser.className = "error_msg";	
		eruser.classList.remove("error-text-hidden");
		console.log("'" + uname.value + "' is not a valid username. Username needs to be a valid Email");
		formIsValid = false;
	}
	else{
		eruser.classList.remove("error_msg");
		//uname.classList.remove("inputerror");
		eruser.classList.add("error-text-hidden");
	}
	
	let password = document.getElementById("password");
	
	if (!checkpassword(password.value)) {
		//password.className = "inputerror";
		erpass.className="error_msg";
		erpass.classList.remove("error-text-hidden");
		console.log("'" + password.value + "' is not a valid password. Password needs to be 8 characters long, at least one non-letter character");
		formIsValid = false;
	}
	else {
		erpass.classList.remove("error_msg");
		//password.classList.remove("inputerror");
		erpass.classList.add("error-text-hidden");
		console.log("validation successful, sending data to the server");
	}

	let fname = document.getElementById("firstname");
	var erfnam = document.getElementById("error-text-firstname");
	
	if (!checkname(fname.value)) {
		//fname.className = "inputerror";
		erfnam.className = "error_msg";	
		erfnam.classList.remove("error-text-hidden");
		console.log("'" + fname.value + "' is not a valid firstname. Name should be without any space or number or special charecter");
		formIsValid = false;
	}
	else {
		erfnam.classList.remove("error_msg");
		//fname.classList.remove("inputerror");
		erfnam.classList.add("error-text-hidden");
		console.log("validation successful, sending data to the server");

	}

	let lname = document.getElementById("lasttname");
	var erlanam = document.getElementById("error-text-lastname");
	
	if (!checkname(lname.value)) {
		//lname.className = "inputerror";
		erlanam.className = "error_msg";	
		erlanam.classList.remove("error-text-hidden");
		console.log("'" + lname.value + "' is not a valid lastname. Name should be without any space or number or special charecter");
		formIsValid = false;
	}
	else {
		erlanam.classList.remove("error_msg");
		//lname.classList.remove("inputerror");
		erlanam.classList.add("error-text-hidden");
		console.log("validation successful, sending data to the server");
	}

	let pwd = document.getElementById("password");
	let cpwd = document.getElementById("cpassword");
	var ercpw = document.getElementById("error-text-cpassword");
	if (pwd.value != cpwd.value) {
		//cpwd.className = "inputerror";
		ercpw.className = "error_msg";	
		ercpw.classList.remove("error-text-hidden");
		formIsValid = false;
		console.log("'" + pwd.value + " and " + cpwd.value + "' is not same");
	}
	else {
		ercpw.classList.remove("error_msg");
		//cpwd.classList.remove("inputerror");
		ercpw.classList.add("error-text-hidden");
		console.log("validation successful, sending data to the server");

	}


	let avatar = document.getElementById("avatar");
	var erava = document.getElementById("error-text-avatar");
	if (!checkavatar(avatar.value)) {
		//avatar.className = "inputerror";
		erava.className = "error_msg";	
		erava.classList.remove("error-text-hidden");
		console.log("'" + avatar.value + "' is not a valid Avatar");
		formIsValid = false;
	}
	else {
		erava.classList.remove("error_msg");
		//avatar.classList.remove("inputerror");
		erava.classList.add("error-text-hidden");
		console.log("validation successful, sending data to the server");
	}

	let dob = document.getElementById("dob");
	var erdob = document.getElementById("error-text-dob");
	if (!checkdob(dob.value)) {
		//dob.className = "inputerror";
		erdob.className = "error_msg";	
		erdob.classList.remove("error-text-hidden");
		console.log("'" + dob.value + "' is not a valid Date of Birth");
		formIsValid = false;
	}
	else {
		erdob.classList.remove("error_msg");
		//dob.classList.remove("inputerror");
		erdob.classList.add("error-text-hidden");
		console.log("validation successful, sending data to the server");

	}
	if (formIsValid === false) {
		event.preventDefault();

	}
	else {

		console.log("validation successful, sending password to the server");
	}
}
