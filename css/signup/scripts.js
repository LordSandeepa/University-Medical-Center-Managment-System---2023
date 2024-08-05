var form_1 = document.querySelector(".form_1");
var form_2 = document.querySelector(".form_2");
var form_3 = document.querySelector(".form_3");
var form_4 = document.querySelector(".form_4");

var form_1_btns = document.querySelector(".form_1_btns");
var form_2_btns = document.querySelector(".form_2_btns");
var form_3_btns = document.querySelector(".form_3_btns");
var form_4_btns = document.querySelector(".form_4_btns");

var form_1_next_btn = document.querySelector(".form_1_btns .btn_next");

var form_2_back_btn = document.querySelector(".form_2_btns .btn_back");
var form_2_next_btn = document.querySelector(".form_2_btns .btn_next");

var form_3_back_btn = document.querySelector(".form_3_btns .btn_back");
var form_3_next_btn = document.querySelector(".form_3_btns .btn_next");

var form_4_back_btn = document.querySelector(".form_4_btns .btn_back");

var form_2_progessbar = document.querySelector(".form_2_progessbar");
var form_3_progessbar = document.querySelector(".form_3_progessbar");
var form_4_progessbar = document.querySelector(".form_4_progessbar");

var btn_done = document.querySelector(".btn_done");
var modal_wrapper = document.querySelector(".modal_wrapper");
var shadow = document.querySelector(".shadow");
var form1_input1 = document.querySelector("#form1_input1");
var form1_input2 = document.querySelector("#form1_input2");
var form1_input3 = document.querySelector("#form1_input3");
var form1_input4 = document.querySelector("#form1_input4");
var form1_input5 = document.querySelector("#form1_input5");

var form2_input1 = document.querySelector("#form2_input1");
var form2_input2 = document.querySelector("#form2_input2");
var form2_input3 = document.querySelector("#form2_input3");
var form2_input4 = document.querySelector("#form2_input4");
var form2_input5 = document.querySelector("#form2_input5");

 var form3_input1 = document.querySelector("#form3_input1");
 var form3_input2 = document.querySelector("#form3_input2");
 var form3_input4 = document.querySelector("#form3_input3");
 var form3_input4 = document.querySelector("#form3_input4");
 var form3_input5 = document.querySelector("#form3_input5");

var form4_input1 = document.querySelector("#form4_input1");
var form4_input2 = document.querySelector("#form4_input2");
var form4_input3 = document.querySelector("#form4_input3");
var form4_input4 = document.querySelector("#form4_input4");
var form4_input5 = document.querySelector("#form4_input5");


form_1_next_btn.addEventListener("click",function(){


    if ((form1_input1.value.trim() === "") || (form1_input2.value.trim() === "") ||  (form1_input3.value.trim() === "") ||(form1_input4.value.trim() === "") || (form1_input5.value.trim() === "")) {
        alert("Please fill in the required field.");
        return;
    }else{
        form_1.style.display = "none";
        form_2.style.display = "block";

        form_1_btns.style.display = "none";
        form_2_btns.style.display = "flex";

        form_2_progessbar.classList.add("active");
    }
    

});

form_2_back_btn.addEventListener("click",function(){
    form_1.style.display = "block";
    form_2.style.display = "none";

    form_1_btns.style.display = "flex";
    form_2_btns.style.display = "none";

    form_2_progessbar.classList.remove("active");

});


form_2_next_btn.addEventListener("click",function(){

    
    if ((form2_input1.value.trim() === "") || (form2_input2.value.trim() === "") ||  (form2_input3.value.trim() === "") ||(form2_input4.value.trim() === "") || (form2_input5.value.trim() === "")) {
        alert("Please fill in the required field.");
        return;
    }else{
    form_2.style.display = "none";
    form_3.style.display = "block";

    form_2_btns.style.display = "none";
    form_3_btns.style.display = "flex";

    form_3_progessbar.classList.add("active");
    }
});

form_3_next_btn.addEventListener("click",function(){

    
    if ((form3_input1.value.trim() === "") || (form3_input2.value.trim() === "") ||  (form3_input3.value.trim() === "") ||(form3_input4.value.trim() === "") || (form3_input5.value.trim() === "")) {
        alert("Please fill in the required field.");
        return;
    }else{
    form_3.style.display = "none";
    form_4.style.display = "block";

    form_3_btns.style.display = "none";
    form_4_btns.style.display = "flex";

    form_4_progessbar.classList.add("active");
    }
});

form_3_back_btn.addEventListener("click",function(){
    form_2.style.display = "block";
   
    form_3.style.display = "none";


    
    form_2_btns.style.display = "flex";
    form_3_btns.style.display = "none";

    form_3_progessbar.classList.remove("active");

});

form_4_back_btn.addEventListener("click",function(){
    form_3.style.display = "block";
   
    form_4.style.display = "none";


    
    form_3_btns.style.display = "flex";
    form_4_btns.style.display = "none";

    form_4_progessbar.classList.remove("active");

});



    btn_done.addEventListener("click",function(){
        if ((form4_input1.value.trim() === "") || (form4_input2.value.trim() === "") ||  (form4_input3.value.trim() === "") ||(form4_input4.value.trim() === "") || (form4_input5.value.trim() === "")) {
            alert("Please fill in the required field.");
            return;
        }else{
            modal_wrapper.classList.add("active");
        }
        
    });

    shadow.addEventListener("click",function(){

        
            modal_wrapper.classList.remove("active");
        
       
    });
