const star1 = document.querySelector("#star1");
const star2 = document.querySelector("#star2");
const star3 = document.querySelector("#star3");
const star4 = document.querySelector("#star4");
const star5 = document.querySelector("#star5");
const stars = document.querySelector("#stars").value;

//for retaining color of stars on page refresh
if(stars === ""){
    star1.style.color = "darkgrey";
    star2.style.color = "darkgrey";
    star3.style.color = "darkgrey";
    star4.style.color = "darkgrey";
    star5.style.color = "darkgrey";
}
if(stars === "1"){
    star1.style.color = "gold";
    star2.style.color = "darkgrey";
    star3.style.color = "darkgrey";
    star4.style.color = "darkgrey";
    star5.style.color = "darkgrey";
}
if(stars === "2"){
    star1.style.color = "gold";
    star2.style.color = "gold";
    star3.style.color = "darkgrey";
    star4.style.color = "darkgrey";
    star5.style.color = "darkgrey";
}
if(stars === "3"){
    star1.style.color = "gold";
    star2.style.color = "gold";
    star3.style.color = "gold";
    star4.style.color = "darkgrey";
    star5.style.color = "darkgrey";
}
if(stars === "4"){
    star1.style.color = "gold";
    star2.style.color = "gold";
    star3.style.color = "gold";
    star4.style.color = "gold";
    star5.style.color = "darkgrey";
}
if(stars === "5"){
    star1.style.color = "gold";
    star2.style.color = "gold";
    star3.style.color = "gold";
    star4.style.color = "gold";
    star5.style.color = "gold";
}
console.log(stars);
function changeStar(){
    const starsVal = document.querySelector("#stars").value;
    
    if(starsVal === ""){
        star1.style.color = "darkgrey";
        star2.style.color = "darkgrey";
        star3.style.color = "darkgrey";
        star4.style.color = "darkgrey";
        star5.style.color = "darkgrey";
    }
    if(starsVal === "1"){
        star1.style.color = "gold";
        star2.style.color = "darkgrey";
        star3.style.color = "darkgrey";
        star4.style.color = "darkgrey";
        star5.style.color = "darkgrey";
    }
    if(starsVal === "2"){
        star1.style.color = "gold";
        star2.style.color = "gold";
        star3.style.color = "darkgrey";
        star4.style.color = "darkgrey";
        star5.style.color = "darkgrey";
    }
    if(starsVal === "3"){
        star1.style.color = "gold";
        star2.style.color = "gold";
        star3.style.color = "gold";
        star4.style.color = "darkgrey";
        star5.style.color = "darkgrey";
    }
    if(starsVal === "4"){
        star1.style.color = "gold";
        star2.style.color = "gold";
        star3.style.color = "gold";
        star4.style.color = "gold";
        star5.style.color = "darkgrey";
    }
    if(starsVal === "5"){
        star1.style.color = "gold";
        star2.style.color = "gold";
        star3.style.color = "gold";
        star4.style.color = "gold";
        star5.style.color = "gold";
    }

}
