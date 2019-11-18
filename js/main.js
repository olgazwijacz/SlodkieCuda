// Hamburger
var hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function () {
document.querySelector(".page-header").classList.toggle("nav-opened");
}, false);

// Formularze 
function focus(e) {
    var elm = $(e.target);
    elm.data('orig-value', elm.val());
    elm.val('');
}

function blur(e) {
    var elm = $(e.target);
    if (!elm.val()) {
        elm.val(elm.data('orig-value'));
    }
}

let fields = document.getElementsByClassName('nowa');

for (let i = 0; i < fields.length; i++) {
    fields[i].addEventListener('focus', focus);
    fields[i].addEventListener('blur', blur);
   
};

// Eliminacja diva
function deleteDiv() {
let arrayOfDivs = document.getElementsByClassName('product-list');
let ostatniDiv = arrayOfDivs[0].lastChild;
ostatniDiv.style.display = 'none';
}
deleteDiv();

// Dodanie elementu "ostatnie realizacje"
function insertBlock() {
let container = document.getElementsByClassName('product-list');
let div = container[0].firstElementChild;
let newTextItem = document.createElement("div");
let classAtr = document.createAttribute("class");
classAtr.value = "box";
container[0].insertBefore(newTextItem, div);
newTextItem.setAttributeNode( classAtr );
let items = document.getElementsByClassName('box');
items[0].innerHTML = ('<div class="imgBox1"><div class="tekst"><h2>Ostatnie realizacje</h2><p>Zapraszam do zapoznania się z moimi realizacjami. We wszystkich wypiekach znajdują się składniki najwyższej jakości, co pozwala uzyskać wyjątkowy i wyrazisty smak.</p><a class="firstBox" href="/realizacje">Zobacz Wszystkie</a></div></div>');

}
insertBlock();

//Ograniczenie liczby wyświetlanych elementów
let content = document.getElementsByClassName('product-list')[0].children;
let newContent= Array.from(content);
for (let i = 10; i < newContent.length; i++) {     
    let currentEl = newContent[i];
    currentEl.style.display = 'none';
};

document.addEventListener("touchstart", function() {}, true);