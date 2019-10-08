
let todo=document.getElementById("TODO");
let carga=document.getElementById("carga");
window.addEventListener('DOMContentLoaded', (event) => {
  setTimeout(()=>{
    console.log(todo,'hola')
    todo.style.display='block'
    carga.style.display='none'
  },7000)

});

function doDelay(wait) {
    
    var date = new Date();
    var startDate = date.getTime();
    var a = 1;
    var b = 0;
    while (a !== 0) {
        date = new Date();
        if ((date.getTime() - startDate) >= wait) {
            a = 0;
        }
        b++;
    }
}

//doDelay(3000);
/*$(window).load(function() {
    $(".CARGADOR").fadeOut("slow");
}); */