// menu UL is open or not ? default = close;
var navUlOpen = false;
let SelectorNavbarToMove = 'nav>ul';
let SelectorNavbarButton = '.nav-ham';

/**
 * if we are in small mode ;
 * and if we click and the hambuger ;
 * and if the var 'navUlOpen' == false
 * we can open it.
*/
function openNavbarWithStyle(selectorOpenNavbarWithStyle){

    let selectorQuery = document.querySelector(selectorOpenNavbarWithStyle);
    // verify if it's not the first time (because has no attributes), and reset the precedent style="".
    if(selectorQuery.attributes[0] !== undefined){
        selectorQuery.attributes[0].value = '';
    }

    // show navbar
    selectorQuery.style.visibility = 'visible';
    selectorQuery.style.opacity = 1;
    selectorQuery.style.height = '100%';
    selectorQuery.style.marginTop = '3rem';

    // effects
    selectorQuery.style.transform = 'rotate(7deg)';
    selectorQuery.style.borderLeft = 'blue solid medium';

    // navbar open
    navUlOpen = true;
    console.log('openNavbarWithStyle');
}
function navbarOrigin(selectorNavbarOrigin){
    // at the first time, the selector as no style="", if defined : rm value of style="".
    if(document.querySelector(selectorNavbarOrigin).attributes[0] !== undefined){
        document.querySelector(selectorNavbarOrigin).attributes[0].value = '';
    }
    navUlOpen = true;
    console.log('navbarOrigin');
}
function closeNavbar(selectorCloseNavbar){
    let selectorQuery = document.querySelector(selectorCloseNavbar);
    // at the first time, the selector as no style="", if defined : rm value of style="".
    // and apply stylich hidding (now in the .CSS part responsive 'nav>ul')
    if(selectorQuery.attributes[0] !== undefined){
        selectorQuery.attributes[0].value = '';
    }

    /**
     * finaly after all this time, we finally find something interessing !
     * document.querySelectorAll(selectorCloseNavbar + ' li').forEach(function(element){
     *      element.style.visibility = 'hidden';
     * });
     */

    navUlOpen = false;
    console.log('closeNavbar');
}

/**
 * on click button : verify state of navUlOpen and open or close navbar.
 * listen dynamic for width of change : big screen
 * in case of re-switch mini : close navbar && navUlOpen = false !
 */
document.querySelector(SelectorNavbarButton).addEventListener("click", function(){
    if(navUlOpen == false){
        openNavbarWithStyle(SelectorNavbarToMove);
    } else {
        closeNavbar(SelectorNavbarToMove);
    }
});
window.matchMedia("(min-width: 650px)").addListener(function(changed) {
    if(changed.matches){
        navbarOrigin(SelectorNavbarToMove);
    } else {
        closeNavbar(SelectorNavbarToMove);
    }
});