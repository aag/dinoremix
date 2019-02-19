const m = require('mithril');

const Permalink = {
  view: (vnode) => {
    const { url } = vnode.attrs;

    return m(
      '.Permalink',
      m('a', { class: 'Permalink__link', href: url }, [
        m('img', { src: '/images/link.png', alt: 'Link' }),
        ' ',
        m('span', { class: 'Permalink__text' }, 'Permalink to this remix'),
      ]),
    );
  },
};

module.exports = Permalink;
