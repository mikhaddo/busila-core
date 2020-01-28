// menu UL is open or not ? default = close;
var navUlOpen = false;

/**
 * if we are in small mode ;
 * and if we click and the hambuger ;
 * and if the var 'navUlOpen' == false
 * we can open it.
*/
function openNavbar(selector){
    console.log(selector + ' :: open standard');
    let selectorQuery = 'document.querySelector(\'' + selector + '\')';
    console.log(selectorQuery);
    selectorQuery.style.display = 'flex';
    selectorQuery.style.border = 'none';
    selectorQuery.style.borderTop = '#00ffe5 solid';
    selectorQuery.style.borderBottom = '#00ffe5 solid';
    selectorQuery.style.marginTop = 'initial';
    selectorQuery.style.transform = "rotate(0deg)";
    navUlOpen = true;
}
function openNavbarWithStyle(){
    console.log('with style');
    document.querySelector('nav>ul').style.display = 'flex';
    document.querySelector('nav>ul').style.transform = 'rotate(7deg)';
    // document.querySelector('nav>ul').style.border = 'blue solid medium';
    // document.querySelector('nav>ul').style.marginTop = '5rem';
    document.querySelector('nav>ul').style.marginTop = '10rem';
    document.querySelector('nav>ul').style.opacity = '1';
    document.querySelector('nav>ul').style.height = '100%';
    navUlOpen = true;
}
function closeNavbar(){
    console.log('nav>ul :: close')
    document.querySelector('nav>ul').style.display = 'flex';
    document.querySelector('nav>ul').style.transform = "rotate(0deg)"
    document.querySelector('nav>ul').style.marginTop = '-2rem';
    document.querySelector('nav>ul').style.opacity = '0';
    document.querySelector('nav>ul').style.position = 'absolute';
    document.querySelector('nav>ul').style.left = 0;
    document.querySelector('nav>ul').style.bottom = 0;

    // document.querySelector('nav>ul').style.marginTop = 'initial';
    navUlOpen = false;
}

/**
 * listen dynamic for width of change : big screen
 * in case of re-switch mini : close navbar && navUlOpen = false !
 */
document.querySelector('.nav-ham').addEventListener("click", function(e){
    if(navUlOpen == false){ openNavbarWithStyle(); } else { closeNavbar(); }
});
window.matchMedia("(min-width: 650px)").addListener(function(changed) {
    if(changed.matches){ openNavbar('nav>ul'); } else { closeNavbar(); }
});