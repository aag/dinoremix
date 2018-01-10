const m = require('mithril');

const Panel = {
  view: (vnode) => {
    const { position, src, altText } = vnode.attrs;

    return m(
      'img.panelImage',
      {
        src,
        id: `${position}Image`,
        alt: altText,
        title: altText,
      },
    );
  },
};

module.exports = Panel;
