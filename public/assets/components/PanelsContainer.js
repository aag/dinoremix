const m = require('mithril');

const ComicLayout = require('../helpers/ComicLayout');
const Url = require('../helpers/Url');

const AltTextEditor = require('./AltTextEditor');
const Panel = require('./Panel');

const PanelsContainer = {
  isMouseAbove: false,

  handleMouseenter: () => {
    PanelsContainer.isMouseAbove = true;
  },

  handleMouseleave: () => {
    PanelsContainer.isMouseAbove = false;
  },

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

    return m('.PanelsContainer', {
      onmouseenter: PanelsContainer.handleMouseenter,
      onmouseleave: PanelsContainer.handleMouseleave,
    }, [panelElements, m(AltTextEditor, { showButton: PanelsContainer.isMouseAbove })]);
  },
};

module.exports = PanelsContainer;
