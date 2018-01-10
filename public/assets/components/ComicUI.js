const m = require('mithril');

const Comic = require('../models/Comic');

const ReloadButton = require('./ReloadButton');
const LocksRow = require('./LocksRow');
const NumPanelsSwitcher = require('./NumPanelsSwitcher');
const PanelsContainer = require('./PanelsContainer');
const Permalink = require('./Permalink');

const ComicUI = {
  handleNumPanelsChanged(numPanels) {
    Comic.numPanels = numPanels;
  },

  view() {
    return m('.comic', [
      m('#linksBar', { class: 'clearfix' }, [
        m(ReloadButton),
        m(NumPanelsSwitcher, {
          numPanels: Comic.numPanels,
          onNumPanelsChanged: this.handleNumPanelsChanged,
        }),
      ]),
      m(LocksRow, { position: 'top', numPanels: Comic.numPanels }),
      m(PanelsContainer, { numPanels: Comic.numPanels, images: Comic.panels, altText: '' }),
      m(LocksRow, { position: 'bottom', numPanels: Comic.numPanels }),
      m(Permalink, { url: Comic.getPermalink() }),
    ]);
  },
};

module.exports = ComicUI;
