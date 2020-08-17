const schoolOption = document.querySelector("#school");
const collegeOption = document.querySelector("#college");
const schoolBox = document.querySelector(".school-box");
const collegeBox = document.querySelector(".college-box");
const primaryBox = document.querySelector(".primary");
const secondaryBox = document.querySelector(".secondary");
const higherSecondaryBox = document.querySelector(".higher-secondary");
const bcaBox = document.querySelector(".bca");
const bbaBox = document.querySelector(".bba");
const bscBox = document.querySelector(".bsc");
const mscitBox = document.querySelector(".mscit");
const bcomBox = document.querySelector(".bcom");
const courseVal = document.querySelector("#course").value;
const classVal2 = document.querySelector("#class").value;

    //for retaining college and school boxes
    if(schoolOption.checked){
        schoolBox.style.display = "block";
        collegeBox.style.display = "none";
    }
    if(collegeOption.checked){
        collegeBox.style.display = "block";
        schoolBox.style.display = "none";
    }

    //for retaining course boxes
    if(courseVal === "BCA" && collegeOption.checked){
        bcaBox.style.display = "block";
    }else{
        bcaBox.style.display = "none";
    }
    if(courseVal === "B.Com" && collegeOption.checked){
        bcomBox.style.display = "block";
    }else{
        bcomBox.style.display = "none";
    }
    if(courseVal === "B.Sc" && collegeOption.checked){
        bscBox.style.display = "block";
    }else{
        bscBox.style.display = "none";
    }
    if(courseVal === "BBA" && collegeOption.checked){
        bbaBox.style.display = "block";
    }else{
        bbaBox.style.display = "none";
    }
    if(courseVal === "M.Sc IT" && collegeOption.checked){
        mscitBox.style.display = "block";
    }else{
        mscitBox.style.display = "none";
    }

    //for retaining classBoxes
    if(classVal2 === "1st-5th" && schoolOption.checked){
        primaryBox.style.display = "block";
    }else{
        primaryBox.style.display = "none";
    }
    if(classVal2 === "6th-10th" && schoolOption.checked){
        secondaryBox.style.display = "block";
    }else{
        secondaryBox.style.display = "none";
    }
    if(classVal2 === "11th-12th" && schoolOption.checked){
        higherSecondaryBox.style.display = "block";
    }else{
        higherSecondaryBox.style.display = "none";
    }

function displayBox(){
    if(schoolOption.checked){
        schoolBox.style.display = "block";
        collegeBox.style.display = "none";
        bcaBox.style.display = "none";
        bbaBox.style.display = "none";
        bcomBox.style.display = "none";
        bscBox.style.display = "none";
        mscitBox.style.display = "none";

    }
    if(collegeOption.checked){
        collegeBox.style.display = "block";
        schoolBox.style.display = "none";
        primaryBox.style.display = "none";
        secondaryBox.style.display = "none";
        higherSecondaryBox.style.display = "none";

    }
}
function showCourseBox(){
    const course = document.querySelector("#course").value;
    if(course === "BCA" && collegeOption.checked){
        bcaBox.style.display = "block";
    }else{
        bcaBox.style.display = "none";
    }
    if(course === "B.Com" && collegeOption.checked){
        bcomBox.style.display = "block";
    }else{
        bcomBox.style.display = "none";
    }
    if(course === "B.Sc" && collegeOption.checked){
        bscBox.style.display = "block";
    }else{
        bscBox.style.display = "none";
    }
    if(course === "BBA" && collegeOption.checked){
        bbaBox.style.display = "block";
    }else{
        bbaBox.style.display = "none";
    }
    if(course === "M.Sc IT" && collegeOption.checked){
        mscitBox.style.display = "block";
    }else{
        mscitBox.style.display = "none";
    }
}
function showClassBox(){
    const classVal = document.querySelector("#class").value;
    if(classVal === "1st-5th"&& schoolOption.checked){
        primaryBox.style.display = "block";
    }else{
        primaryBox.style.display = "none";
    }
    if(classVal === "6th-10th"&& schoolOption.checked){
        secondaryBox.style.display = "block";
    }else{
        secondaryBox.style.display = "none";
    }
    if(classVal === "11th-12th"&& schoolOption.checked){
        higherSecondaryBox.style.display = "block";
    }else{
        higherSecondaryBox.style.display = "none";
    }
}