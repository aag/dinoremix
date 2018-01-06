const m = require('mithril');

const Panel = require('./Panel');

const PanelsContainer = {
  view: (vnode) => {
    const { images, altText } = vnode.attrs;

    return m('#panelContainer', [
      m(Panel, { position: 'tl', src: `/panels/topleft/${images.tl}`, altText }),
      m(Panel, { position: 'tm', src: `/panels/topmiddle/${images.tm}`, altText }),
      m(Panel, { position: 'tr', src: `/panels/topright/${images.tr}`, altText }),
      m(Panel, { position: 'bl', src: `/panels/bottomleft/${images.bl}`, altText }),
      m(Panel, { position: 'bm', src: `/panels/bottommiddle/${images.bm}`, altText }),
      m(Panel, { position: 'br', src: `/panels/bottomright/${images.br}`, altText }),
    ]);
  },
};

module.exports = PanelsContainer;
