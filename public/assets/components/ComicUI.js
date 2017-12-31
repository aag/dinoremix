const m = require('mithril');

const Comic = require('../models/Comic');

const ReloadButton = require('./ReloadButton');
const NumPanelsSwitcher = require('./NumPanelsSwitcher');
const Permalink = require('./Permalink');

const ComicUI = {
  view: () =>
    m('.comic', [
      m('#linksBar', { class: 'clearfix' }, [
        m(ReloadButton),
        m(NumPanelsSwitcher, { numPanels: Comic.numPanels }),
      ]),
      m(Permalink, { url: Comic.getPermalink() }),
    ]),
};

module.exports = ComicUI;
