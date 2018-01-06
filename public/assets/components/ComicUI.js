const m = require('mithril');

const Comic = require('../models/Comic');

const ReloadButton = require('./ReloadButton');
const LocksRow = require('./LocksRow');
const NumPanelsSwitcher = require('./NumPanelsSwitcher');
const Panels = require('./Panels');
const Permalink = require('./Permalink');

const ComicUI = {
  view: () =>
    m('.comic', [
      m('#linksBar', { class: 'clearfix' }, [
        m(ReloadButton),
        m(NumPanelsSwitcher, { numPanels: Comic.numPanels }),
      ]),
      m(LocksRow, { position: 'top', numPanels: Comic.numPanels }),
      m(Panels, { numPanels: Comic.numPanels, images: Comic.panels, altText: '' }),
      m(LocksRow, { position: 'bottom', numPanels: Comic.numPanels }),
      m(Permalink, { url: Comic.getPermalink() }),
    ]),
};

module.exports = ComicUI;
