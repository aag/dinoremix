const m = require('mithril');

const ComicLayout = require('../helpers/ComicLayout');
const Panel = require('./Panel');

const PanelsContainer = {
  view: (vnode) => {
    const { altText, images, numPanels } = vnode.attrs;

    const panels = ComicLayout
      .getVisiblePanels(numPanels)
      .map((panel) => {
        const { position, directory } = panel;
        return m(Panel, {
          altText,
          position,
          src: `/panels/${directory}/${images[position]}`,
        });
      });

    return m('#panelContainer', panels);
  },
};

module.exports = PanelsContainer;
