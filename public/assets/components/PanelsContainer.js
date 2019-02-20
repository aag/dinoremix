const m = require('mithril');

const ComicLayout = require('../helpers/ComicLayout');
const Url = require('../helpers/Url');

const AltTextEditor = require('./AltTextEditor');
const Panel = require('./Panel');

const PanelsContainer = {
  view: (vnode) => {
    const { altText, panels, numPanels } = vnode.attrs;

    const panelElements = ComicLayout
      .getVisiblePanels(numPanels)
      .map((panel) => {
        const { position } = panel;
        return m(Panel, {
          altText,
          position,
          src: Url.getImageUrl(position, panels[position]),
        });
      });

    return m('.PanelsContainer', [panelElements, m(AltTextEditor)]);
  },
};

module.exports = PanelsContainer;
