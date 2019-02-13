const m = require('mithril');

const ComicLayout = require('../helpers/ComicLayout');
const Url = require('../helpers/Url');
const Panel = require('./Panel');

const PanelsContainer = {
  view: (vnode) => {
    const { altText, images, numPanels } = vnode.attrs;

    const panels = ComicLayout
      .getVisiblePanels(numPanels)
      .map((panel) => {
        const { position } = panel;
        return m(Panel, {
          altText,
          position,
          src: Url.getImageUrl(position, images[position]),
        });
      });

    return m('#panelContainer', panels);
  },
};

module.exports = PanelsContainer;
