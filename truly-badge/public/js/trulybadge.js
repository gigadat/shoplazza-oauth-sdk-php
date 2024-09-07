(function () {
    var script = document.createElement('script');

    const scripts = Array.from(document.getElementsByTagName('script'));
    const trulyBadgeScript = scripts.find(s => s.src.includes('trulybadge_qa.js'));
    const siteId = trulyBadgeScript ? new URLSearchParams(new URL(trulyBadgeScript.src).search).get('siteId') : null;

    script.src = 'https://badge.trulylegit.com/api/tlv1?siteId=' + siteId;
    script.async = true;

    var entry = document.getElementsByTagName('script')[0];
    entry.parentNode.insertBefore(script, entry);
})();
