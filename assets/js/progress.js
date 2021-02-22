document.addEventListener('DOMContentLoaded', function () {

    window.addEventListener('scroll', function () {

        const scrollTop =
            document.documentElement.scrollTop ||
            document.body.scrollTop;

        const scrollHeight =
            document.documentElement.scrollHeight -
            document.documentElement.clientHeight;

        const progress =
            (scrollTop / scrollHeight) * 100;

        const bar =
            document.getElementById('srp-progress-bar');

        if (bar) {
            bar.style.width = progress + '%';
        }
    });

});