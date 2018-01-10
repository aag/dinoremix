const m = require('mithril');

const Permalink = {
  view: (vnode) => {
    const { url } = vnode.attrs;

    return m(
      '#permalinkHolder',
      m('a', { id: 'permaLink', href: url }, [
        m('img', { src: '/images/link.png', alt: 'Link' }),
        ' ',
        m('span', { class: 'permaLinkText' }, 'Permalink to this remix'),
      ]),
    );
  },
};

module.exports = Permalink;
