/*** javaScript natif, visionnette 0.5.0 by Titus ***/
var articleImg = 'article .article-row-right img';
var bigImgAllreadyExposed = false;

/**
 * function for displaying img in full-screen
 * with pink overlay && image-bigger
 * arguments : this->element (this small image), querySelector for div of images
 */
function displayImg(element,divSmallImg){

    bigImgAllreadyExposed = true;

    // reduce currently hooved img (if ':hover' exist, because not in crappy smartphones)
    if(document.querySelector(divSmallImg + ':hover') !== null){
        document.querySelector(divSmallImg + ':hover').style.transform = 'initial';
    }

    // create div & stylize for overlay : (.overlay-pink)
    document.body.prepend(document.createElement('div'));
    document.body.firstChild.className = 'overlay-pink';
    let overlayLarge = document.querySelector('.overlay-pink');
    overlayLarge.style.position='fixed';
    overlayLarge.style.top =  0;
    overlayLarge.style.bottom = 0;
    overlayLarge.style.left = 0;
    overlayLarge.style.right = 0;
    overlayLarge.style.backgroundColor = 'rgb(230, 175, 250,0.7)';

    // create img element && stylize in (.overlay-pink to imgBigger)
    overlayLarge.prepend(document.createElement('img'));
    overlayLarge.firstChild.className = 'img-bigger';
    let imgBigger = document.querySelector('.img-bigger');
    imgBigger.style.position='absolute';
    imgBigger.style.width = '80%';
    imgBigger.style.left = '50%';
    imgBigger.style.top =  '50%';
    imgBigger.style.transform = 'translate(-50%, -50%)';

    // Open overlay image. search if thumbnail.
    // slice(20) rm 'img/portfolio/thumb_' slice(20,-4) rm also '.png' ; slice(18) for /public/img/thumbs
    // else, if dit not find thumb, draw whatever it is.
    // default : needs the extension '.jpg', more likely case sensitive.
    if(element.attributes[0].nodeValue.slice(0,20) == 'img/portfolio/thumb_'){
        imgBigger.src = ('img/portfolio/' + element.attributes[0].nodeValue.slice(20));
    } else {
        imgBigger.src = element.attributes[0].nodeValue;
    }

    // click on dis thing for rm overlay and everything on it ; and get to the choppa.
    overlayLarge.addEventListener('click', function(){
        overlayLarge.parentElement.removeChild(overlayLarge);
        return bigImgAllreadyExposed = false;
    });

};

/**
 * stalking click on all img(s) (articleImg);
 * if overlay is not open, then open-it : NOW !
 * and stalk mouse hove | un-hove over img for zooming.
 */
document.querySelectorAll(articleImg).forEach(function(element){
    element.addEventListener('mouseover', function(){
        document.querySelector(articleImg + ':hover').style.transform = 'scale(2)';
    });
    element.addEventListener('mouseout', function(){
            this.style.transform = 'initial';
    });
    element.addEventListener('click', function(){
        // prevent multiplication of overlay(s), we are saved, everything will not collapsing in pink.
        if( typeof(bigImgAllreadyExposed) == 'undefined' || bigImgAllreadyExposed ){
            // if the guy spam click so fast on thumbs
            // or variable is not defined (prevent dependance error but as long not drawing img)
            console.log('don\'t do dat, it is gonna fail.')
            // tordu, but neanmoins it's drawing img ! (because procedural mode)
            if(typeof(bigImgAllreadyExposed) == 'undefined'){
                displayImg(this, articleImg);
            }
        } else {
            displayImg(this, articleImg);
        }
    });
});