(function () {
  function shouldOpenInNewTab(link) {
    const href = link.getAttribute('href') || '';
    const text = (link.textContent || '').trim().toLowerCase();
    const rowAction = link.closest('.row-actions .view');
    const adminBarView = link.closest('#wp-admin-bar-view, #wp-admin-bar-preview');
    const previewUrl = href.includes('preview=true') || href.includes('preview_id=');
    const viewText = /^(ver|vista|view|preview|previsualizar)(\s|$)/i.test(text);

    if (!href || href.startsWith('#') || href.includes('/wp-admin/')) {
      return false;
    }

    return Boolean(rowAction || adminBarView || previewUrl || viewText);
  }

  function markViewLinks(root) {
    root.querySelectorAll('a[href]').forEach(function (link) {
      if (!shouldOpenInNewTab(link)) {
        return;
      }

      link.setAttribute('target', '_blank');
      link.setAttribute('rel', 'noopener noreferrer');
    });
  }

  function init() {
    markViewLinks(document);

    const observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        mutation.addedNodes.forEach(function (node) {
          if (node.nodeType !== Node.ELEMENT_NODE) {
            return;
          }

          if (node.matches && node.matches('a[href]')) {
            markViewLinks(node.parentElement || document);
            return;
          }

          if (node.querySelectorAll) {
            markViewLinks(node);
          }
        });
      });
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
