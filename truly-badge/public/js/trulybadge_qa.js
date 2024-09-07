(function () {
    var script = document.createElement('script');

    // var scripts = document.getElementsByTagName('script');
    // let siteId = null;
    // for (let i = 0; i < scripts.length; i++) {
    //     if (scripts[i].src.includes('trulybadge_qa.js')) {
    //         siteId = new URLSearchParams(scripts[i].src.split('?')[1]).get('siteId');
    //         break;
    //     }
    // }
    const scripts = Array.from(document.getElementsByTagName('script'));
    const trulyBadgeScript = scripts.find(s => s.src.includes('trulybadge_qa.js'));
    const siteId = trulyBadgeScript ? new URLSearchParams(new URL(trulyBadgeScript.src).search).get('siteId') : null;

    console.log('siteId found: ', siteId);
    
    script.src = 'https://kmgu6d1qxk.execute-api.us-east-2.amazonaws.com/test/api/tlv1?siteId=' + siteId;
    script.async = true;

    var entry = document.getElementsByTagName('script')[0];
    entry.parentNode.insertBefore(script, entry);
})();
