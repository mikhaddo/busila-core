/**
 * functions color on the fomulaire
 */
function formEventClick(element){ element.style.border = 'solid blue 4px'; }
function formEventFocusout(element){
   if(element.value.length > 0){
      element.style.border = 'solid green 4px';
   } else {
      element.style.border = 'solid red 4px';
   }

   if(
      element.id == 'email' &&
      /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,3}$/.exec(element.value) == null
   ){
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
 * submit with verification captcha
 */
document.querySelector('#submit').addEventListener("click", function(e){
   // remove last message error captcha if is exist
   if(document.querySelector('.childrenOfErrorCaptchaClass') != null){
      document.querySelector('.childrenOfErrorCaptchaClass').parentElement.removeChild(document.querySelector('.childrenOfErrorCaptchaClass'));
   }

   // if captcha not valid, create new element error, draw it, and reload function random captcha.
   if(document.querySelector('#form-captcha-eco').value != randCapNumberResult){
      let childrenOfErrorCaptcha;
      childrenOfErrorCaptcha = document.createElement('p');
      childrenOfErrorCaptcha.className = 'childrenOfErrorCaptchaClass';
      childrenOfErrorCaptcha.style.color = 'red';
      childrenOfErrorCaptcha.textContent = 'erreur, chiffre invalide, réessayez.';
      document.querySelector('#form-captcha-eco').parentElement.before(childrenOfErrorCaptcha);
      e.preventDefault();
      randCapNumber();
   }

});

/**
 * Reset : create new button or confirmation ; and if it is click, clear all values of all champs.
 */
document.querySelector('#reset').addEventListener("click", function(e){

   // variable about the ID of ResetOkButton, need everywhere in here. && prevent reload of page.
   let resetOkButtonIdString = 'ok';
   e.preventDefault();

   // if OkButton exist (not null)
   if(document.getElementById(resetOkButtonIdString) != null){

      // 'toggle' the button ok
      document.getElementById(resetOkButtonIdString).parentElement.removeChild(document.getElementById(resetOkButtonIdString));

   } else {

      // else : create the ok button.
      let resetOkButton;
      resetOkButton = document.createElement('button');
      resetOkButton.type = 'reset';
      resetOkButton.id = resetOkButtonIdString;
      resetOkButton.value = 'reset';
      resetOkButton.textContent = 'ok';
      resetOkButton.style.backgroundColor = 'red';
      resetOkButton.style.margin = '2%';
      resetOkButton.style.position = 'relative';
      resetOkButton.style.left = '-12vw';
      document.querySelector('#reset').after(resetOkButton);

      document.getElementById(resetOkButtonIdString).addEventListener("click", function(e){

         // window.location.replace('home#form-contact'); #not really working on the second time !
         document.getElementById(resetOkButtonIdString).parentElement.removeChild(document.getElementById(resetOkButtonIdString));
         if(document.querySelector('.childrenOfErrorCaptchaClass') != null){
            document.querySelector('.childrenOfErrorCaptchaClass').parentElement.removeChild(document.querySelector('.childrenOfErrorCaptchaClass'));
         }

         // clear all values
         document.querySelector('#name').value = null;
         document.querySelector('#email').value = null;
         document.querySelector('#subject').firstElementChild.children[0].selected = true;
         document.querySelector('#textarea').value = null;
         document.querySelector('#form-captcha-eco').value = null;

      });

   }

});