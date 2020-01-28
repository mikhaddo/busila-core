// variables
var regexEmail = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,3}$/;
let childrenOfCaptcha = document.querySelector('#form-captcha-eco-txt').parentElement.parentElement;

/**
 * functions color on the fomulaire
 */
function formEventClick(element){
      element.style.border = 'solid blue 4px';
}
function formEventFocusout(element){
   if(element.value.length >0){
      element.style.border = 'solid green 4px';
   } else {
      element.style.border = 'solid red 4px';
   }
   if( element.id == 'email' && ( regexEmail.exec(element.value) == null ) ){
      element.style.border = 'solid red 4px';
   }
}

// eventListener colors : click = formEventClick, mouseout = formEventFocusout;
document.querySelectorAll('input, textarea, select').forEach( function(element){
   element.addEventListener("click", function(){ formEventClick(this) });
});
document.querySelectorAll('input, textarea, select').forEach( function(element){
   element.addEventListener("focusout", function(){ formEventFocusout(this) });
});

/**
 * generations numbers for captcha
 * and drop one instance at the start
 */
function randCapNumber(){
   randCapNumber01 = 10;
   randCapNumber02 = Math.floor(Math.random() * Math.floor(10));
   randCapNumberResult = randCapNumber01 + randCapNumber02;

   document.getElementById('form-captcha-eco-txt').textContent = randCapNumber01 + ' + ' +  randCapNumber02 + ' = ';
}
randCapNumber();

/**
 * verification captcha
 */
document.querySelector('#submit').addEventListener("click", function(e){
   if(document.querySelector('#form-captcha-eco').value != randCapNumberResult){
      errorCaptchaTxt = document.createElement('p');
      errorCaptchaTxt.className = 'errorCaptchaTxt'
      errorCaptchaTxt.style.color = 'red';
      errorCaptchaTxt.textContent = 'erreur, chiffre invalide, recharge la page stp, ou demande de l\'aide au webmestre.';
      document.querySelector('#form-captcha-eco').parentElement.before(errorCaptchaTxt);
      e.preventDefault();
      randCapNumber();
   }
   // with var childrenOfCaptcha; two (isset(<p class="errorCaptchaTxt">))? remove the last one !
   if( childrenOfCaptcha.children[1].className == 'errorCaptchaTxt' ){
      childrenOfCaptcha.removeChild(childrenOfCaptcha.children[1]);
   }
});