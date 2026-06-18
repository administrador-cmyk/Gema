(function () {
  'use strict';

  var root = document.querySelector('[data-gema-cart-checkout]');
  if (!root) {
    return;
  }

  var apiBase = (window.GEMA_CART_CONFIG && window.GEMA_CART_CONFIG.restBase) || '/wp-json/gema-payments/v1';
  var contactUrl = (window.GEMA_CART_CONFIG && window.GEMA_CART_CONFIG.contactUrl) || '/contacto/';
  var erpSignupUrl = (window.GEMA_CART_CONFIG && window.GEMA_CART_CONFIG.erpSignupUrl) || 'https://cumbre-erp-prod.web.app';
  var sessionId = sessionStorage.getItem('gema_cart_session') || '';
  var lastCartItems = {};

  function readUtm() {
    var params = new URLSearchParams(window.location.search);
    return {
      utm_source: params.get('utm_source') || '',
      utm_medium: params.get('utm_medium') || '',
      utm_campaign: params.get('utm_campaign') || '',
      utm_content: params.get('utm_content') || '',
      utm_term: params.get('utm_term') || ''
    };
  }

  function headers() {
    var h = { 'Content-Type': 'application/json' };
    if (sessionId) {
      h['x-gema-cart-session'] = sessionId;
    }
    return h;
  }

  function renderStatus(message, isError) {
    var el = root.querySelector('[data-cart-status]');
    if (!el) {
      return;
    }
    el.textContent = message;
    el.className = isError ? 'gema-cart-status gema-cart-status--error' : 'gema-cart-status';
  }

  function buildSignupUrl(customer, packageSku) {
    var params = new URLSearchParams();
    params.set('signup', '1');
    params.set('sku', packageSku || 'erp_pymes_trial');
    if (customer.email) {
      params.set('email', customer.email);
    }
    if (customer.company) {
      params.set('company', customer.company);
    }
    var skus = Object.keys(lastCartItems || {});
    if (skus.length > 1) {
      params.set('skus', skus.join(','));
    }
    return erpSignupUrl.replace(/\/$/, '') + '/?' + params.toString();
  }

  function renderCatalog(catalog, cart) {
    var list = root.querySelector('[data-cart-catalog]');
    if (!list) {
      return;
    }
    lastCartItems = (cart && cart.items) ? cart.items : {};
    list.innerHTML = '';
    Object.keys(catalog).forEach(function (sku) {
      var item = catalog[sku];
      var qty = cart.items && cart.items[sku] ? cart.items[sku].qty : 0;
      var row = document.createElement('div');
      row.className = 'gema-cart-row';
      row.innerHTML =
        '<div><strong>' + item.label + '</strong><p>' + item.description + '</p><small>' + item.price_label + '</small></div>' +
        '<div><button type="button" data-add-sku="' + sku + '">' + (qty > 0 ? 'En carrito (' + qty + ')' : 'Agregar') + '</button></div>';
      list.appendChild(row);
    });
    list.querySelectorAll('[data-add-sku]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        addItem(btn.getAttribute('data-add-sku'));
      });
    });
  }

  function loadCart() {
    renderStatus('Cargando catálogo…', false);
    fetch(apiBase + '/cart' + (sessionId ? '?session_id=' + encodeURIComponent(sessionId) : ''), { credentials: 'same-origin' })
      .then(function (res) {
        return res.json();
      })
      .then(function (data) {
        if (data.session) {
          sessionId = data.session;
          sessionStorage.setItem('gema_cart_session', sessionId);
        }
        renderCatalog(data.catalog || {}, data.cart || { items: {} });
        renderStatus('Elegí un plan y completá tus datos para activar trial o coordinar con ventas.', false);
      })
      .catch(function () {
        renderStatus('No pudimos cargar el carrito. Probá de nuevo o usá contacto comercial.', true);
      });
  }

  function addItem(sku) {
    fetch(apiBase + '/cart/items', {
      method: 'POST',
      headers: headers(),
      credentials: 'same-origin',
      body: JSON.stringify({ sku: sku, qty: 1 })
    })
      .then(function (res) {
        return res.json();
      })
      .then(function () {
        loadCart();
      })
      .catch(function () {
        renderStatus('Error al agregar ítem.', true);
      });
  }

  function checkout(event) {
    event.preventDefault();
    var form = root.querySelector('[data-cart-form]');
    if (!form) {
      return;
    }
    var name = form.querySelector('[name="name"]').value.trim();
    var email = form.querySelector('[name="email"]').value.trim();
    var phone = form.querySelector('[name="phone"]').value.trim();
    var company = form.querySelector('[name="company"]').value.trim();

    if (!name || !email || !phone) {
      renderStatus('Completá nombre, email y teléfono.', true);
      return;
    }

    renderStatus('Registrando intención de checkout…', false);

    var utm = readUtm();

    fetch(apiBase + '/cart/checkout', {
      method: 'POST',
      headers: headers(),
      credentials: 'same-origin',
      body: JSON.stringify({
        customer: { name: name, email: email, phone: phone, company: company },
        utm: utm
      })
    })
      .then(function (res) {
        return res.json();
      })
      .then(function (data) {
        if (data.status === 'empty_cart') {
          renderStatus('Agregá al menos un producto al carrito.', true);
          return;
        }
        var signupUrl = data.signup_url || data.next_step || buildSignupUrl(
          { email: email, company: company },
          data.package_sku || Object.keys(lastCartItems)[0]
        );
        renderStatus(data.message || 'Registramos tu intención. Creá tu cuenta en Cumbre ERP.', false);
        root.querySelector('[data-cart-next]').innerHTML =
          '<p><strong>Próximo paso:</strong> creá tu cuenta en ERP Cumbre con el paquete elegido (<code>' +
          (data.package_sku || 'trial') +
          '</code>) para activar trial automático.</p>' +
          '<p><a class="btn-cta-primary" href="' + signupUrl + '" target="_blank" rel="noopener">Crear cuenta en Cumbre ERP</a> ' +
          '<a href="' + contactUrl + '">O coordinar con ventas</a></p>';
      })
      .catch(function () {
        renderStatus('Error en checkout. Probá contacto comercial.', true);
      });
  }

  var form = root.querySelector('[data-cart-form]');
  if (form) {
    form.addEventListener('submit', checkout);
  }

  loadCart();
})();
