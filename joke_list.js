setInterval(rating, 20000);
function rating(){
let xhr = new XMLHttpRequest();
xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        
        let avgrating = null;
        // TODO 6a: Parse the response text into JSON format and keep it on the 'loginHistoryArray' variable;
        
        avgrating = JSON.parse(this.responseText);
        
        
        if (avgrating.length>0){
            let j = 5;
            let k=1;
                for(let i = 0;i<avgrating.length;i++) {

                    let jsonObject = avgrating[i];
                    let avg = jsonObject.avg_rating;

                    const list_right = document.getElementById("list_right").children[i+1];
                    // TODO 6c: create p tag for each loginTime and append that tag as a child of the lastLoginDiv.  
                        const avgp = document.createElement("p");
                        avgp.textContent=avg ;
                        
                        list_right.replaceChild(avgp,list_right.children[5]) ;
                        
                        
                        


                    // TODO 6b: Loop Ends
                    }

        }else{
            console.log("error");
        }
            
        }
    }
    xhr.open("GET","ajax_backendjokelist2.php",true);
    xhr.send();
}
setInterval(ratingL, 20000);
function ratingL(){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            
            let avgrating = null;
            // TODO 6a: Parse the response text into JSON format and keep it on the 'loginHistoryArray' variable;
            
            avgrating = JSON.parse(this.responseText);
            
            
            if (avgrating.length>0){
                let j = 5;
                let k=1;
                    for(let i = 0;i<avgrating.length;i++) {
    
                        let jsonObject = avgrating[i];
                        let avg = jsonObject.avg_rating;
    
                        const list_right = document.getElementById("list_left").children[i+1];
                        // TODO 6c: create p tag for each loginTime and append that tag as a child of the lastLoginDiv.  
                            const avgp = document.createElement("p");
                            avgp.textContent=avg ;
                            
                            list_right.replaceChild(avgp,list_right.children[3]) ;
                            
                            
                            
    
    
                        // TODO 6b: Loop Ends
                        }
    
            }else{
                console.log("error");
            }
                
            }
        }
        xhr.open("GET","ajax_backendjokelist2L.php",true);
        xhr.send();
    }
setInterval(jokes, 90000);
function jokes(){
    let xhr = new XMLHttpRequest();
   xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200){

            let joking = null;
            // TODO 6a: Parse the response text into JSON format and keep it on the 'loginHistoryArray' variable;
            
            joking = JSON.parse(this.responseText);
            let rightmain = document.getElementById("list_right");
            let si=joking.length;
            //rightside.innerHTML = '';
            if (si>0){
                    for(let i = (joking.length-1);i>-1;i--){
						let jsonObject = joking[i];
						let first_name = jsonObject.first_name;
						let avatar = jsonObject.avatar;
						let joke_tittle = jsonObject.joke_tittle;
						let joke = jsonObject.joke;
						let post_date = jsonObject.post_date;
                        let joke_id =  jsonObject.joke_id;
                        let avg =  jsonObject.avg_rating;
                        
				// TODO 6c: create p tag for each loginTime and append that tag as a child of the lastLoginDiv.
                            let rightside = document.createElement("div"); 
                            rightside.classList.add("list_rightjoke");                                                 
							let fname = document.createElement("p");
							fname.textContent = first_name;
							rightside.appendChild(fname);
                            let avat = document.createElement("p");
                            let avat1 = document.createElement("img");
                            avat1.classList.add("img2");
                            avat1.src=avatar;
							avat.appendChild(avat1);
							rightside.appendChild(avat);
                            var a = document.createElement('a');
                            var link = document.createTextNode(joke_tittle);
                            a.appendChild(link);
                            a.href = "joke_details.php?joke_id="+joke_id;
                            let joke_ti = document.createElement("p");
							joke_ti.appendChild(a);
							rightside.appendChild(joke_ti);
                            let jok = document.createElement("p");
							jok.textContent = joke;
							rightside.appendChild(jok);
                            let  post_da = document.createElement("p");
                            post_da.textContent =  post_date;
                            rightside.appendChild( post_da);
                            let  av = document.createElement("p");
                            av.textContent =  avg;
                            rightside.appendChild(av);
                            rightmain.insertBefore(rightside,rightmain.children[1]);
                            let numb = document.getElementById("list_right").childElementCount;
                            console.log(numb);
                            if(numb>21)
                               { rightmain.removeChild(rightmain.lastElementChild);}
                            	                                                                                                                                       
						// TODO 6b: Loop Ends
						}
                        si=0;

            }else{
               xhr.abort();
            }
				
			}
		}
		xhr.open("GET","ajax_backendjokelist.php",true);
		xhr.send();
}
setInterval(jokesL, 90000);
function jokesL(){
    let xhr = new XMLHttpRequest();
   xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200){

            let joking = null;
            // TODO 6a: Parse the response text into JSON format and keep it on the 'loginHistoryArray' variable;
            
            joking = JSON.parse(this.responseText);
            let rightmain = document.getElementById("list_left");
            let si=joking.length;
            //rightside.innerHTML = '';
            if (si>0){
                    for(let i = (joking.length-1);i>-1;i--){
						let jsonObject = joking[i];
						let first_name = jsonObject.first_name;
						let avatar = jsonObject.avatar;
						let joke_tittle = jsonObject.joke_tittle;
						let joke = jsonObject.joke;
						let post_date = jsonObject.post_date;
                        let joke_id =  jsonObject.joke_id;
                        let avg =  jsonObject.avg_rating;
                        
				// TODO 6c: create p tag for each loginTime and append that tag as a child of the lastLoginDiv.
                            let rightside = document.createElement("div"); 
                            rightside.classList.add("list_rightjoke");                                                 
							let fname = document.createElement("p");
							fname.textContent = first_name;
							rightside.appendChild(fname);
                            let joke_ti = document.createElement("p");
                            joke_ti.textContent =joke_tittle;
							rightside.appendChild(joke_ti);
                            let jok = document.createElement("p");
							jok.textContent = joke;
							rightside.appendChild(jok);
                            let  post_da = document.createElement("p");
                            post_da.textContent =  post_date;
                            rightside.appendChild( post_da);
                            let  av = document.createElement("p");
                            av.textContent =  avg;
                            rightside.appendChild(av);
                            rightmain.insertBefore(rightside,rightmain.children[1]);
                            let numb = document.getElementById("list_left").childElementCount;
                            console.log(numb);
                            if(numb>21)
                               { rightmain.removeChild(rightmain.lastElementChild);}
                            	                                                                                                                                       
						// TODO 6b: Loop Ends
						}
                        si=0;

            }else{
               xhr.abort();
            }
				
			}
		}
		xhr.open("GET","ajax_backendjokelistL.php",true);
		xhr.send();
}