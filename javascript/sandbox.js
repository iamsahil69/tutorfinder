
    const schoolOption = document.querySelector("#School");
    const collegeOption = document.querySelector("#College");
    const schoolBox = document.querySelector(".school");
    const collegeBox = document.querySelector(".college");
    const primary = document.querySelector(".primary");
    const secondary = document.querySelector(".secondary");
    const higherSec = document.querySelector(".higher-secondary");
    const response = document.querySelector("#Class").value;
    const BCA = document.querySelector(".BCA");
    const BCOM = document.querySelector(".BCOM");
    const BBA = document.querySelector(".BBA");
    const BSC = document.querySelector(".BSC");
    const MSCIT = document.querySelector(".MSC-IT");
    const course = document.querySelector("#Course").value;
    console.log(BBA);

    if(schoolOption.checked){
        schoolBox.style.display = "block";
        collegeBox.style.display = "none";
    }
    if(collegeOption.checked){
        collegeBox.style.display = "block";
        schoolBox.style.display = "none";
    }


    
    if(response === "1st-5th" && schoolOption.checked){
        primary.style.display = "block";
    }else{
        primary.style.display = "none";
    }

    if(response === "6th-10th" && schoolOption.checked){
        secondary.style.display = "block";
    }else{
        secondary.style.display = "none";
    }

    if(response === "11th-12th" && schoolOption.checked){
        higherSec.style.display = "block";
    }else{
        higherSec.style.display = "none";
    }


    function showHide(){
    if(schoolOption.checked){
        schoolBox.style.display = "block";
        collegeBox.style.display = "none";
        BCA.style.display = "none";
        BBA.style.display = "none";
        BSC.style.display = "none";
        MSCIT.style.display = "none";
        BCOM.style.display = "none";

    }
    if(collegeOption.checked){
        collegeBox.style.display = "block";
        schoolBox.style.display = "none";
        primary.style.display = "none";
        secondary.style.display = "none";
        higherSec.style.display = "none";
    }
 
}
    // on refreshing page keeping the div selected
    
    if(course === "B.Com" && collegeOption.checked){
        BCOM.style.display = "block";
    }else{
        BCOM.style.display = "none";
    }
    if(course === "BBA" && collegeOption.checked){
        BBA.style.display = "block";
    }else{
        BBA.style.display = "none";
    }
    if(course === "B.Sc" && collegeOption.checked){
        BSC.style.display = "block";
    }else{
        BSC.style.display = "none";
    }
    if(course === "M.Sc IT" && collegeOption.checked){
        MSCIT.style.display = "block";
    }else{
        MSCIT.style.display = "none";
    }
    if(course == "BCA" && collegeOption.checked){
        BCA.style.display = "block";
    }else{
        BCA.style.display = "none";
    }

    function display(){
        const response = document.querySelector("#Class").value;

        if(response === "1st-5th" && schoolOption.checked){
            primary.style.display = "block";
        }else{
            primary.style.display = "none";
        }

        if(response === "6th-10th" && schoolOption.checked){
            secondary.style.display = "block";
        }else{
            secondary.style.display = "none";
        }

        if(response === "11th-12th" && schoolOption.checked){
            higherSec.style.display = "block";
        }else{
            higherSec.style.display = "none";
        }
    }

    function display2(){
        const course = document.querySelector("#Course").value;
        console.log("You have selected : "+course);
        if(course === "B.Com" && collegeOption.checked){
            BCOM.style.display = "block";
        }else{
            BCOM.style.display = "none";
        }
        if(course === "BBA" && collegeOption.checked){
            BBA.style.display = "block";
        }else{
            BBA.style.display = "none";
        }
        if(course === "B.Sc" && collegeOption.checked){
            BSC.style.display = "block";
        }else{
            BSC.style.display = "none";
        }
        if(course === "M.Sc IT" && collegeOption.checked){
            MSCIT.style.display = "block";
        }else{
            MSCIT.style.display = "none";
        }
        if(course == "BCA" && collegeOption.checked){
            BCA.style.display = "block";
        }else{
            BCA.style.display = "none";
        }
    }

