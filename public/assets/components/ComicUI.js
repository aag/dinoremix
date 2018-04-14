const m = require('mithril');

const Comic = require('../models/Comic');

const ReloadButton = require('./ReloadButton');
const LocksRow = require('./LocksRow');
const NumPanelsSwitcher = require('./NumPanelsSwitcher');
const PanelsContainer = require('./PanelsContainer');
const CreditsRow = require('./CreditsRow');
const Permalink = require('./Permalink');

const ComicUI = {
  view() {
    const numPanels = +m.route.param('numpanels') || 3;

    return m('.comic', [
      m('#linksBar', { class: 'clearfix' }, [
        m(ReloadButton),
        m(NumPanelsSwitcher, { numPanels }),
      ]),
      m(LocksRow, { position: 'top', numPanels }),
      m(PanelsContainer, { numPanels, images: Comic.panels, altText: '' }),
      m(CreditsRow),
      m(LocksRow, { position: 'bottom', numPanels }),
      m(Permalink, { url: Comic.getPermalink() }),
    ]);
  },
};

module.exports = ComicUI;
