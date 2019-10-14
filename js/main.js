var hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function () {
document.querySelector(".page-header").classList.toggle("nav-opened");
}, false);


  // let obszar = document.getElementsByClassName('nowa');
    // // console.log(obszar);
    
    let arrayOfNowa= Array.from(document.getElementsByClassName('nowa'));
    
    // console.log(arrayOfNowa);
    
    for (var i = 0; i < arrayOfNowa.length; i++) {     
     console.log(arrayOfNowa[i].value)
    };


function changeValue(e){
    let zmienione = e.target
   if (zmienione.value == 'Imię...' || 'Twój adres email...'|| 'Wiadomość...' || 'Temat...') {
    zmienione.value = '';
   } 
}

let fields = document.getElementsByClassName('nowa');

for (let i = 0; i < fields.length; i++) {
    fields[i].addEventListener('focus', changeValue);
}


 
function backValue() {

}


for (let i = 0; i < fields.length; i++) {
    fields[i].addEventListener('blur', backValue);
}


