
(function() {
    mw.loader.using(['mediawiki.util']).then(function() {
        const elements = document.getElementsByClassName('kage');
        for(var svg of elements) {
            var img = new Image();
            img.src = 'data:image/svg+xml,' + encodeURIComponent(svg.outerHTML);
            img.classList.add('kage');
            img.addEventListener('load', function() {
                svg.parentElement.insertBefore(img, svg);
                svg.parentElement.removeChild(svg);
                img.style.display = 'inline-block';
            });
        }
    })
})();