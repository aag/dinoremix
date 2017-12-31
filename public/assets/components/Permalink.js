const m = require('mithril');

const Permalink = {
  view: vnode =>
    m(
      '#permalinkHolder',
      m('a', { id: 'permaLink', href: vnode.attrs.url }, [
        m('img', { src: '/images/link.png', alt: 'Link' }),
        ' ',
        m('span', { class: 'permaLinkText' }, 'Permalink to this remix'),
      ]),
    ),
};

module.exports = Permalink;
