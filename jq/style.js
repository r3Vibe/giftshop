$(document).ready(function(){
    //home
    $("#home").on("click",function(){
        $(".homec").fadeIn("fast");
        $(".productc").hide();                                                 
        $(".categoryc").hide();                 
        $(".orderc").hide();                 
        $(".msgc").hide();                 
    });

    //products
    $("#product").on("click",function(){
        $(".homec").hide();
        $(".productc").fadeIn("fast");                                                 
        $(".categoryc").hide();                 
        $(".orderc").hide();                 
        $(".msgc").hide(); 
    });

    //categories
    $("#category").on("click",function(){
        $(".homec").hide();
        $(".productc").hide();                                                 
        $(".categoryc").fadeIn("slow");                 
        $(".orderc").hide();                 
        $(".msgc").hide(); 
    });

    //orders
    $("#order").on("click",function(){
        $(".homec").hide();
        $(".productc").hide();   
        $(".categoryc").hide();                                               
        $(".orderc").fadeIn("slow");                 
        $(".msgc").hide(); 
    });

    //messages
    $("#msg").on("click",function(){
        $(".homec").hide();
        $(".productc").hide();   
        $(".categoryc").hide();                                               
        $(".orderc").hide();                 
        $(".msgc").fadeIn("slow"); 
    });
});