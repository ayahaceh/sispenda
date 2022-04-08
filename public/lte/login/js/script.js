


$( document ).ready(function() {
    var arr = ['BG-default-1.JPG','16023.jpg','Earsip-VL.jpg'];
    
    var i = 0;
    setInterval(function(){
        if(i == arr.length - 1){
            i = 0;
        }else{
            i++;
        }
        var img = 'url(../../../upload/app/logos/'+arr[i]+')';
        $(".full-bg").css('background-image',img); 
     
    }, 4000)

});



