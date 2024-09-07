(function () {
    var script = document.createElement('script');

    var siteId = new URLSearchParams(window.location.search).get('siteId');

    script.src = 'https://kmgu6d1qxk.execute-api.us-east-2.amazonaws.com/test/api/tlv1?siteId=' + siteId;
    script.async = true;

    var entry = document.getElementsByTagName('script')[0];
    entry.parentNode.insertBefore(script, entry);
})();
