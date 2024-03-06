function increase()
{
    let rating = document.getElementById("rate");
    let incre = document.getElementById("increase");
    let decre = document.getElementById("decrease");
    var rate=rating.value;
    rating.value = parseInt(rate) +1;
    if(parseInt(rating.value) === 5){
        incre.classList.add("hide");
     }
     else{
         incre.classList.remove("hide")
     }
     if(parseInt(rating.value) ===0){
        decre.classList.add("hide");
     }
     else{
         decre.classList.remove("hide")
     }

    
    
}
function decrease(){
    let rating = document.getElementById("rate");
    let incre = document.getElementById("increase");
    let decre = document.getElementById("decrease");
    var rate=rating.value;
    rating.value =parseInt(rate) -1;
    if(parseInt(rating.value) === 5){
        incre.classList.add("hide");
     }
     else{
         incre.classList.remove("hide")
     }
    if(parseInt(rating.value) === 0){
        decre.classList.add("hide");
     }
     else{
         decre.classList.remove("hide")
     }
    
}
function ratings() {

	// TODO 4b: Get the username from the event target
	let rating1 = document.getElementById("rate");
    let rating =parseInt(rating1.value);
    let xhr = new XMLHttpRequest();
   xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {

            let jokerating = null;
            // TODO 6a: Parse the response text into JSON format and keep it on the 'loginHistoryArray' variable;
            
            jokerating = JSON.parse(this.responseText);
            let lasttext = document.getElementById("last-login");
            lasttext.innerHTML = '';
            if (jokerating.length>0){
                    for(let i = 0;i<jokerating.length;i++) {

						let jsonObject = jokerating[i];
						let ratted = jsonObject.rating;


						// TODO 6c: create p tag for each loginTime and append that tag as a child of the lastLoginDiv.  
							let rate = document.createElement("p");
							rate.textContent = "You have rated the joke "+ratted+" out of 5";
							lasttext.append(rate);


						// TODO 6b: Loop Ends
						}

            }else{
                const pTag = document.createElement("p");
					const textnode = document.createTextNode("No previous rating found.");
					pTag.appendChild(textnode);
					lasttext.appendChild(pTag);
            }
				
			}
		}
		xhr.open("GET","ajax_backendjokedet.php?q="+rating,true);
		xhr.send();
	
}