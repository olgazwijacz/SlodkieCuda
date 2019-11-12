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

function deleteDiv() {
let arrayOfDivs = document.getElementsByClassName('product-list');
let ostatniDiv = arrayOfDivs[0].lastChild;
ostatniDiv.style.display = 'none';
}
deleteDiv();


function insertBlock() {
let container = document.getElementsByClassName('product-list');
let div = container[0].firstElementChild;
let newTextItem = document.createElement("div");
let classAtr = document.createAttribute("class");
classAtr.value = "box";
container[0].insertBefore(newTextItem, div);
newTextItem.setAttributeNode( classAtr );
let aa = document.getElementsByClassName('box');
aa[0].innerHTML = ('<div class="imgBox1"><div class="tekst"><h2>Ostatnie realizacje</h2><p>Zapraszam do zapoznania się z moimi realizacjami. We wszystkich wypiekach znajdują się składniki najwyższej jakości, co pozwala uzyskać wyjątkowy i wyrazisty smak.</p><a class="firstBox" href="/realizacje">Zobacz Wszystkie</a></div></div>');

}
insertBlock();
