const m = require('mithril');

const Url = require('../helpers/Url');

const Comic = {
  lockedPanels: [],
  numPanels: 3,
  panels: {
    tl: '100',
    tm: '100',
    tr: '100',
    bl: '100',
    bm: '100',
    br: '100',
  },

  getLockedPanelsFromUrl: () => {
    const lockedPanelsString = Url.getQueryParam('locked');
    let lockedPanels = [];
    if (lockedPanelsString) {
      lockedPanels = lockedPanelsString.split('-');
    }

    return lockedPanels;
  },

  getPermalink: () => Url.setPanels(Comic.panels),

  loadFromUrl: () => {
    Object.keys(Comic.panels).forEach((panel) => {
      const comicId = m.route.param(panel);
      if (comicId) {
        Comic.panels[panel] = comicId;
      }
    });

    Comic.numPanels = +m.route.param('numpanels') || Comic.numPanels;
    Comic.lockedPanels = Url.getLockedPanels();
  },
};

module.exports = Comic;
