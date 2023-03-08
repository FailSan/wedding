/********************************************************************/
/***** GRAPHICS *****************************************************/
/********************************************************************/

let feedContainer = document.querySelector('main');
let heroContainer = document.querySelector('[data-content="home"]');
let whenContainer = document.querySelector('[data-content="when"]');
let churchContainer = document.querySelector('[data-content="church"]');
let castleContainer = document.querySelector('[data-content="castle"]');

window.addEventListener('load', initiateWindow);
window.addEventListener('resize', initiateWindow);
window.addEventListener('orientationchange', initiateWindow);

function initiateWindow() {
    let perc = 100 * (feedContainer.scrollTop + feedContainer.clientHeight) / feedContainer.scrollHeight;
    percentageLine.style.setProperty('--percentage', perc + '%');

    churchContainer.style.top = - (churchContainer.scrollHeight - feedContainer.clientHeight) + "px";
    castleContainer.style.top = - (castleContainer.scrollHeight - feedContainer.clientHeight) + "px";
}

let menuOpener = document.querySelector('nav [data-open]');
menuOpener.addEventListener('click', openMenu);

function openMenu() {
    let menu = document.querySelector('nav menu');

    if(menuOpener.dataset.open == 1) {
        menuOpener.src = menuOpener.src.replace('close', 'open');
        menuOpener.dataset.open = 0;
        menu.classList.add('hidden');
    } else {
        menuOpener.src = menuOpener.src.replace('open', 'close');
        menuOpener.dataset.open = 1;
        menu.classList.remove('hidden');
    }
}

let contentLinks = document.querySelectorAll('nav menu .link');
let contentPages = document.querySelectorAll('.pages');
for(let i = 0; i < contentLinks.length; i++) {
    contentLinks[i].addEventListener('click', showContent);
}

function showContent(event) {
    event.preventDefault();

    let currentLink = event.currentTarget;
    let currentContent = currentLink.dataset.page;
    let currentPage = document.querySelector('.pages[data-content="' + currentContent + '"]');

    let prevIterator = Array.prototype.indexOf.call(contentPages, currentPage);

    let scrollToPage = 0;
    if(prevIterator > 0) {
        for(i = 0; i < prevIterator; i++) {
            scrollToPage = scrollToPage + contentPages[i].scrollHeight;
        }
    }
    openMenu();
    feedContainer.scrollTop = scrollToPage;
}

let percentageLine = document.querySelector('nav .percentage');
feedContainer.addEventListener('scroll', fillPercentage);

function fillPercentage() {
    let perc = 100 * (feedContainer.scrollTop + feedContainer.clientHeight) / feedContainer.scrollHeight;
    percentageLine.style.setProperty('--percentage', perc + '%');
}

let footerArrow = document.querySelector('footer #footer_arrow');
footerArrow.addEventListener('click', showHome);

function showHome(event) {
    event.preventDefault();

    feedContainer.scrollTop = 0;
}

let faqLinks = document.querySelectorAll('.faqs .question .link');
for(let i = 0; i < faqLinks.length; i++) {
    faqLinks[i].addEventListener('click', showAnswer);
}

function showAnswer(event) {
    event.preventDefault();

    let currentLink = event.currentTarget;
    let currentArrow = currentLink.querySelector('img');
    let currentAnswer = currentLink.nextElementSibling;

    currentLink.classList.toggle('active');
    currentArrow.classList.toggle('active');
    currentAnswer.classList.toggle('hidden');
}


/********************************************************************/
/***** COUNTDOWN ****************************************************/
/********************************************************************/

let countContainer = document.querySelector('.countdown');
window.addEventListener('load', runCountDown);

function runCountDown() {
    let dayContainer = countContainer.querySelector('[data-time="days"]');
    let hourContainer = countContainer.querySelector('[data-time="hours"]');
    let minuteContainer = countContainer.querySelector('[data-time="minutes"]');
    let secondContainer = countContainer.querySelector('[data-time="seconds"]');
    
    let weddingDate = new Date('Jul 13, 2023 16:30:00');

    setInterval(function() {
        let scrollFix = feedContainer.scrollTop;

        let todayDate = new Date();
        let dateDiff = weddingDate - todayDate;

        let days = Math.floor(dateDiff / (1000 * 60 * 60 * 24));
        let hours = Math.floor((dateDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((dateDiff % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((dateDiff % (1000 * 60)) / 1000);

        dayContainer.textContent = "- " + days + "D";
        hourContainer.textContent = hours + "H";
        minuteContainer.textContent = minutes + "M";
        secondContainer.textContent = seconds + "S";

        feedContainer.scrollTop = scrollFix;
    }, 1000);
}


/********************************************************************/
/***** SCROLLFIX ****************************************************/
/********************************************************************/

let photos = document.querySelectorAll('.photos');
for(let i = 0; i < photos.length; i++) {
    photos[i].addEventListener('click', paintPhotos);
}

function paintPhotos(event) {
    event.preventDefault();

    let scrollFix = feedContainer.scrollTop;

    let currentImage = event.currentTarget;
    currentImage.classList.toggle('paint');

    feedContainer.scrollTop = scrollFix;
}