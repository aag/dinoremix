const m = require('mithril');

const Panel = {
  view: (vnode) => {
    const { position, src, altText } = vnode.attrs;

    return m(
      'img.Panel',
      {
        src,
        class: `Panel--${position}`,
        alt: altText,
        title: altText,
      },
    );
  },
};

module.exports = Panel;
