const m = require('mithril');

const Permalink = {
  view: (vnode) => {
    const { url } = vnode.attrs;

    return m('a.Permalink', { href: url }, 'Permalink to this remix');
  },
};

module.exports = Permalink;
