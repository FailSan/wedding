/********************************************************************/
/***** GRAPHICS *****************************************************/
/********************************************************************/

let mainDocument = document.documentElement;
let whenContainer = document.querySelector('[data-content="when"]');
let churchContainer = document.querySelector('[data-content="church"]');
let castleContainer = document.querySelector('[data-content="castle"]');

window.addEventListener('load', initiateWindow);
window.addEventListener('load', hideLoader);
window.addEventListener('resize', initiateWindow);
window.addEventListener('orientationchange', initiateWindow);
window.addEventListener('scroll', fillPercentage);

function hideLoader() {
    let loader = document.querySelector('.loader');

    setTimeout(function() {
        loader.classList.add('hidden');
        setTimeout(() => loader.remove(), 2000);
    }, 2000);
}

let percentageLine = document.querySelector('nav .percentage');

function fillPercentage() {
    let perc = 100 * (window.scrollY + mainDocument.clientHeight) / mainDocument.scrollHeight;
    percentageLine.style.setProperty('--percentage', perc + '%');
}

function initiateWindow() {
    fillPercentage();
    
    if(whenContainer.scrollHeight > mainDocument.clientHeight) {
        whenContainer.style.top = - (whenContainer.style.top + whenContainer.scrollHeight - mainDocument.clientHeight) + "px";
    }

    churchContainer.style.top = - (churchContainer.style.top + churchContainer.scrollHeight - mainDocument.clientHeight) + "px";
    castleContainer.style.top = - (castleContainer.style.top + castleContainer.scrollHeight - mainDocument.clientHeight) + "px";
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
    window.scroll(0, scrollToPage);
}


let footerArrow = document.querySelector('footer #footer_arrow');
footerArrow.addEventListener('click', showHome);

function showHome(event) {
    event.preventDefault();

    window.scroll(0, 0);
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

function runCountDown() {
    let dayContainer = countContainer.querySelector('[data-time="days"]');
    let hourContainer = countContainer.querySelector('[data-time="hours"]');
    let minuteContainer = countContainer.querySelector('[data-time="minutes"]');
    let secondContainer = countContainer.querySelector('[data-time="seconds"]');
    
    let weddingDate = new Date('Jul 13, 2023 16:30:00');

    setInterval(function() {
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
    }, 1000);
}

runCountDown();