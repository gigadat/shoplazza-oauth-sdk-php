(function () {
    const scripts = Array.from(document.getElementsByTagName('script'));
    const trulyBadgeScript = scripts.find(s => s.src.includes('trulybadge_qa.js'));
    const siteId = trulyBadgeScript ? new URLSearchParams(new URL(trulyBadgeScript.src).search).get('siteId') : null;

    // if script with tlv1 already exists, replace it with the new one
    const existingScript = scripts.find(s => s.src.includes('tlv1'));
    if (existingScript) {
        existingScript.remove();
    }
    
    var script = document.createElement('script');
    script.src = 'https://kmgu6d1qxk.execute-api.us-east-2.amazonaws.com/test/api/tlv1?siteId=' + siteId;
    script.async = true;

    var entry = document.getElementsByTagName('script')[0];
    entry.parentNode.insertBefore(script, entry);
})();
