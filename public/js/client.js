window.onload = function () {
    setTimeout(function () {
        let getClient = new XMLHttpRequest();
        getClient.open('GET', '//api.ipify.org?format=json', false);
        getClient.setRequestHeader('Content-type', 'application/json');
        getClient.send();
        getClient.open('GET', `https://ipapi.co/${JSON.parse(getClient.response).ip}/json/`, false);
        getClient.setRequestHeader('Content-type', 'application/json');
        getClient.send();
        let ips = getClient.response;
        getClient.open('POST', window.location.origin + '/ip-address');
        getClient.setRequestHeader('Content-type', 'application/json');
        getClient.setRequestHeader("X-CSRF-Token", $('meta[name="csrf_token"]').attr('content'));
        getClient.send(ips);
    }, 500)
};
