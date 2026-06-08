(function () {
  const w = window;
  const d = document;

  w.dataLayer = w.dataLayer || [];

  const pushEvent = (eventName, payload = {}) => {
    w.dataLayer.push({
      event: eventName,
      page_path: w.location.pathname,
      page_title: d.title,
      ...payload
    });
  };

  const cleanText = (value) => {
    if (!value) return '';
    return value.replace(/\s+/g, ' ').trim().slice(0, 120);
  };

  const classifyLink = (anchor) => {
    const href = anchor.getAttribute('href') || '';
    const text = cleanText(anchor.textContent || anchor.getAttribute('aria-label') || '');
    const lowerHref = href.toLowerCase();
    const lowerText = text.toLowerCase();

    if (lowerHref.startsWith('tel:')) return 'phone';
    if (lowerHref.startsWith('mailto:')) return 'email';
    if (lowerHref.includes('wa.me') || lowerHref.includes('api.whatsapp.com') || lowerHref.includes('whatsapp')) return 'whatsapp';
    if (lowerHref.includes('/contacto') || lowerText.includes('contact')) return 'contact';
    if (lowerHref.includes('/prueba-gratis') || lowerText.includes('prueba')) return 'trial';
    if (lowerText.includes('demo') || lowerHref.includes('demo')) return 'demo';
    if (lowerHref.includes('/erp-cumbre') || lowerHref.includes('/cumbre')) return 'cumbre_navigation';

    return '';
  };

  d.addEventListener('DOMContentLoaded', () => {
    pushEvent('gema_page_ready');
  });

  d.addEventListener(
    'click',
    (event) => {
      const target = event.target;
      if (!(target instanceof Element)) return;

      const anchor = target.closest('a[href]');
      if (anchor) {
        const ctaType = classifyLink(anchor);
        if (ctaType) {
          pushEvent('gema_cta_click', {
            cta_type: ctaType,
            cta_text: cleanText(anchor.textContent || anchor.getAttribute('aria-label') || ''),
            cta_url: anchor.href
          });
        }
      }

      const agentTopic = target.closest('[data-agent-topic]');
      if (agentTopic) {
        pushEvent('gema_agent_topic_click', {
          agent_topic: agentTopic.getAttribute('data-agent-topic') || '',
          cta_text: cleanText(agentTopic.textContent || '')
        });
      }

      const agentToggle = target.closest('[data-gema-floating-agent] .gema-floating-agent__button');
      if (agentToggle) {
        pushEvent('gema_agent_open');
      }
    },
    true
  );

  d.addEventListener(
    'submit',
    (event) => {
      const form = event.target;
      if (!(form instanceof HTMLFormElement)) return;

      const formId = form.getAttribute('id') || '';
      const formName = form.getAttribute('name') || '';
      const formClass = form.className || '';
      const isAgentForm = form.matches('.gema-floating-agent__form');

      pushEvent(isAgentForm ? 'gema_agent_message_submit' : 'gema_form_submit', {
        form_id: formId,
        form_name: formName,
        form_class: cleanText(String(formClass))
      });
    },
    true
  );
})();
