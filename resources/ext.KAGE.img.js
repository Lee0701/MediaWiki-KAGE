
(function() {
    mw.loader.using(['mediawiki.util']).then(function() {
        const elements = document.getElementsByClassName('kage');
        for(var svg of elements) {
            var parent = svg.parentNode;
            if(!svg || !parent) continue;
            var img = new Image();
            var content = svg.outerHTML.split('\n').map((line) => line.trim()).join('');
            img.src = 'data:image/svg+xml,' + encodeURIComponent(content);
            img.classList.add('kage');
            parent.insertBefore(img, svg);
            parent.removeChild(svg);
            img.addEventListener('load', function() {
                img.style.display = 'inline-block';
            });
        }
    })
})();