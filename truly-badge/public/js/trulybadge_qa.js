(function () {
    var script = document.createElement('script');

    var siteId = new URLSearchParams(window.location.search).get('siteId');

    // get siteId from cookie
    if (!siteId) {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].split('=');
            if (cookie[0].trim() === 'siteId') {
                siteId = cookie[1];
                break;
            }
        }
    }

    console.log('siteId found: ', siteId);

    script.src = 'https://kmgu6d1qxk.execute-api.us-east-2.amazonaws.com/test/api/tlv1?siteId=' + siteId;
    script.async = true;

    var entry = document.getElementsByTagName('script')[0];
    entry.parentNode.insertBefore(script, entry);
})();
