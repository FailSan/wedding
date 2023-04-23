window.addEventListener('load', hideLoader);
function hideLoader() {
    let loaderDocument = document.querySelector('.modal-loading');
    setTimeout(function() {
        loaderDocument.classList.add('hidden');

        setTimeout(function() {
            loaderDocument.remove();
        }, 2000);
    }, 2000);
}