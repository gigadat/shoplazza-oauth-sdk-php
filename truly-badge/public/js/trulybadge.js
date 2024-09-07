(function () {
    var script = document.createElement('script');

    var siteId = new URLSearchParams(window.location.search).get('siteId');

    script.src = 'https://badge.trulylegit.com/api/tlv1?siteId=' + siteId;
    script.async = true;

    var entry = document.getElementsByTagName('script')[0];
    entry.parentNode.insertBefore(script, entry);
})();
