

var btn_done = document.querySelector(".btn_done");
var modal_wrapper = document.querySelector(".modal_wrapper");
var shadow = document.querySelector(".shadow");





    btn_done.addEventListener("click",function(){
       
          modal_wrapper.classList.add("active");
           
       
        
    });

    shadow.addEventListener("click",function(){

        
            modal_wrapper.classList.remove("active");
        
       
    });
