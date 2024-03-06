

function counter(event) {
    let titleid = document.getElementById("tittle");
    const titlebox = document.querySelector('.tittle');
    const count = document.querySelector('.counter');
    const limitms = document.querySelector('.limit');
    titlebox.disabled = false;
    var titlestr = String(titleid.value);
    var titlelenght = titlestr.length;
    count.innerText = titlelenght;
    if (titlelenght === 50) {
        limitms.innerText = 'reched';
    }
    else{
        limitms.innerText = 'Good'
    }
}
function disablepost(event) {
    let titleid = document.getElementById("tittle");
    var titlestr = String(titleid.value);
    var titlelenght = titlestr.length;
    let joke = document.getElementById("jokepo");
    var jokestr = String(joke.value);
    var jokelenght = jokestr.length;
    console.log(jokelenght);
    console.log(titlelenght);
    var titlegood = false;
    if (titlelenght == 0 || jokelenght == 0) {
        titlegood = false;
    }
    else {
        titlegood = true;
    }
    if (titlegood === false) {
		event.preventDefault();

	}
	else {

		console.log("validation successful, sending password to the server");
	}
}