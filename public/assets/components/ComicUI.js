const m = require('mithril');

const NumPanelsSwitcher = require('./NumPanelsSwitcher');
const Permalink = require('./Permalink');

const ComicUI = {
  view: () =>
    m('.comic', [
      m('#linksBar', { class: 'clearfix' }, [
        m(NumPanelsSwitcher),
      ]),
      m(Permalink),
    ]),
};

module.exports = ComicUI;
