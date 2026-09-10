(function () {
    'use strict';
    var config = window.amsSecurity;
    function action(url) {
        return url.origin === location.origin && config.actions.indexOf(url.pathname.split('/').pop()) !== -1;
    }
    function field(form, name, value) {
        var input = document.createElement('input');
        input.type = 'hidden'; input.name = name; input.value = value; form.appendChild(input);
    }
    function secureForm(form) {
        var url = new URL(form.action || location.href, location.href);
        if (url.origin !== location.origin) return;
        if (action(url)) form.method = 'post';
        if (form.method.toLowerCase() !== 'post') return;
        var input = form.querySelector('input[name="csrf_token"]');
        if (input) input.value = config.token; else field(form, 'csrf_token', config.token);
    }
    document.addEventListener('DOMContentLoaded', function () {
        Array.prototype.forEach.call(document.forms, secureForm);
    });
    document.addEventListener('submit', function (event) { secureForm(event.target); }, true);
    document.addEventListener('click', function (event) {
        var link = event.target.closest ? event.target.closest('a[href]') : null;
        if (!link || event.defaultPrevented) return;
        var url = new URL(link.href, location.href);
        if (!action(url)) return;
        event.preventDefault();
        var form = document.createElement('form'); form.method = 'post'; form.action = url.pathname;
        url.searchParams.forEach(function (value, key) { field(form, key, value); });
        field(form, 'csrf_token', config.token); document.body.appendChild(form); form.submit();
    });
    // Covers same-origin legacy AJAX requests without putting tokens in URLs.
    var open = XMLHttpRequest.prototype.open, send = XMLHttpRequest.prototype.send;
    XMLHttpRequest.prototype.open = function (method, url) {
        this.amsSameOrigin = new URL(url, location.href).origin === location.origin;
        return open.apply(this, arguments);
    };
    XMLHttpRequest.prototype.send = function () {
        if (this.amsSameOrigin) this.setRequestHeader('X-CSRF-Token', config.token);
        return send.apply(this, arguments);
    };
})();
