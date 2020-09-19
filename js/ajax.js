window.addEventListener('load',function(){

var xhr = new XMLHttpRequest();
var ajax = document.querySelector('#ajax');

    xhr.open('GET','js/ajax.php?term='+ajax.value, true);
    //console.log(xhr.responseText);


ajax.addEventListener('keyup', function(){
    xhr.onreadystatechange = function(){
        if(xhr.readyState===4 && xhr.status===200){
                //this.value = xhr.responseText;
            //document.querySelector('#span').innerHTML=xhr.responseText;
            alert('ti');
                //console.log(xhr);
                //this.value=;
        }
    }

})
    xhr.send();



})
