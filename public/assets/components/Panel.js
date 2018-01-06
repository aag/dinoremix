const m = require('mithril');

const Panel = {
  view: vnode =>
    m(
      'img.panelImage',
      {
        id: `${vnode.attrs.position}Image`,
        src: vnode.attrs.src,
        alt: vnode.attrs.altText,
        title: vnode.attrs.altText,
      },
    ),
};

module.exports = Panel;
