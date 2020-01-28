// variable
var articleImg = 'article .article-row-right img';

/**
 * function for displaying img in full-screen
 * with pink overlay && image-bigger
 * arguments : this->element (this small image), querySelector for div of images
 */
function displayImg(element,divSmallImg){

    // reduce currently hooved img (if ':hover' exist, because not in crappy smartphones)
    if(document.querySelector(divSmallImg + ':hover') !== null){
        document.querySelector(divSmallImg + ':hover').style.transform = 'initial';
    }

    // create div & stylize for overlay : (.overlay-pink)
    document.body.prepend(document.createElement('div'));
    document.body.firstChild.className = 'overlay-pink';
    let overlayPink = document.querySelector('.overlay-pink');
    overlayPink.style.position='fixed';
    overlayPink.style.top =  0;
    overlayPink.style.bottom = 0;
    overlayPink.style.left = 0;
    overlayPink.style.right = 0;
    overlayPink.style.backgroundColor = 'rgb(230, 175, 250,0.7)';

    // create img element && stylize in (.overlay-pink to imgBigger)
    document.querySelector('.overlay-pink').prepend(document.createElement('img'));
    document.querySelector('.overlay-pink').firstChild.className = 'img-bigger';
    let imgBigger = document.querySelector('.img-bigger');
    imgBigger.style.position='absolute';
    imgBigger.style.width = '80%';
    imgBigger.style.left = '50%';
    imgBigger.style.top =  '50%';
    imgBigger.style.transform = 'translate(-50%, -50%)';

    // Open overlay image. * slice(20) rm 'img/portfolio/thumb_' slice(20,-4) rm also '.png'
    // else, if dit not find thumb, draw standard miniature.
    if(element.attributes[0].nodeValue.slice(0,20) == 'img/portfolio/thumb_'){
        imgBigger.src = ('img/portfolio/' + element.attributes[0].nodeValue.slice(20));
    } else {
        imgBigger.src = element.attributes[0].nodeValue;
    }

    // click on dis thing for rm overlay and everything on it ; and get to the choppa.
    overlayPink.addEventListener('click', function(){
        overlayPink.parentElement.removeChild(overlayPink);
    });

};

/**
 * stalking click on all img(s) (articleImg);
 * if overlay is not open, then open-it : NOW !
 * and stalk mouse hove | un-hove over img for zooming.
 */
document.querySelectorAll(articleImg).forEach(function(e){
    e.addEventListener('mouseover', function(){
        document.querySelector(articleImg + ':hover').style.transform = 'scale(2)';
    });
    e.addEventListener('mouseout', function(){
        document.querySelectorAll(articleImg).forEach(function(e){
            e.style.transform = 'initial';
        });
    });
    e.addEventListener('click', function(){
        // prevent multiplication of overlay(s), we are saved, everything will not collapsing in pink.
        if(!document.querySelector('.overlay-pink')){
            displayImg(this, articleImg);
        }else{
            // if the guy spam click so fast on thumbs
            console.log('don\'t do dat, it is gonna fail.')
        };
    });
});