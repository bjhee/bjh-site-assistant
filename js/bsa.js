// Add back to top function to a button with given ID
function backtoTop(btnId) {
    var btn = document.getElementById(btnId);
    var doc = document.documentElement;
    var body = document.body;
    var showBack = function() {
        btn.style.display = (doc.scrollTop + body.scrollTop) > 100 ? 'block' : 'none';
    }

    window.onscroll = showBack;
    btn.onclick = function() {
        btn.style.display = 'none';
        window.onscroll = null;

        this.timer = setInterval(function() {
            doc.scrollTop -= Math.ceil((doc.scrollTop + body.scrollTop) * 0.1);
            body.scrollTop -= Math.ceil((doc.scrollTop + body.scrollTop) * 0.1);
            if ((doc.scrollTop + body.scrollTop) == 0) {
                clearInterval(btn.timer);
                window.onscroll = showBack;
            }
        }, 10);
    }
}
