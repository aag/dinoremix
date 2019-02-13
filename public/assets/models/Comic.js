const m = require('mithril');

const Url = require('../helpers/Url');

const Comic = {
  numPanels: 3,
  panels: {
    tl: '100',
    tm: '100',
    tr: '100',
    bl: '100',
    bm: '100',
    br: '100',
  },
  nextPanels: {},
  areNextPanelsLoading: false,

  getLockedPanelsFromUrl: () => {
    const lockedPanelsString = Url.getQueryParam('locked');
    let lockedPanels = [];
    if (lockedPanelsString) {
      lockedPanels = lockedPanelsString.split('-');
    }

    return lockedPanels;
  },

  getPermalink: () => Url.setPanels(Comic.panels),

  getNextPanelsLink: () => {
    const lockedPanels = Comic.getLockedPanelsFromUrl();

    const panels = {};
    Object.keys(Comic.panels).forEach((pos) => {
      if (!lockedPanels.includes(pos) && Comic.nextPanels[pos]) {
        panels[pos] = Comic.nextPanels[pos];
      } else {
        panels[pos] = Comic.panels[pos];
      }
    });

    return Url.setPanels(panels);
  },

  loadPanelsFromUrl: () => {
    Object.keys(Comic.panels).forEach((panel) => {
      const comicId = m.route.param(panel);
      if (comicId) {
        Comic.panels[panel] = comicId;
      }
    });
  },

  loadNextPanels: () => {
    if (Comic.areNextPanelsLoading) {
      return undefined;
    }

    Comic.areNextPanelsLoading = true;

    return m.request({
      method: 'GET',
      url: '/api/images/random',
    })
      .then((result) => {
        result.forEach((panel) => {
          Comic.nextPanels[panel.pos] = panel.id;
        });

        Comic.areNextPanelsLoading = false;
      });
  },
};

module.exports = Comic;
