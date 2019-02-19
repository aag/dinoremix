const m = require('mithril');

const Comic = require('../models/Comic');

const ButtonsRow = require('./ButtonsRow');
const LocksRow = require('./LocksRow');
const PanelsContainer = require('./PanelsContainer');
const CreditsRow = require('./CreditsRow');
const Permalink = require('./Permalink');

const ComicUI = {
  oninit: () => Comic.loadFromGlobal(),

  view: () => {
    Comic.loadFromUrl();
    const { numPanels, panels, altText } = Comic;

    return m('.comic', { class: `Comic Comic--${numPanels}_panels` }, [
      m(ButtonsRow, { numPanels }),
      m(LocksRow, { position: 'top', numPanels }),
      m(PanelsContainer, { numPanels, panels, altText }),
      m(CreditsRow),
      m(LocksRow, { position: 'bottom', numPanels }),
      m(Permalink, { url: Comic.getPermalink() }),
    ]);
  },
};

module.exports = ComicUI;
