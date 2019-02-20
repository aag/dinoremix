const m = require('mithril');

const Comic = require('../models/Comic');
const RandomPanels = require('../models/RandomPanels');
const Url = require('../helpers/Url');

const ReloadButton = {
  oninit: () => RandomPanels.loadFromGlobal(),

  onupdate: () => {
    if (Comic.getPermalink() === ReloadButton.getNextPanelsUrl() &&
        !Comic.allPanelsLocked()) {
      return RandomPanels.fetchFromServer();
    }

    return null;
  },

  view: () => m(
    'a.ReloadButton', {
      class: 'Button Button--with-icon ReloadButton',
      href: ReloadButton.getNextPanelsUrl(),
      oncreate: m.route.link,
    },
    'Reload the unlocked panels',
  ),

  getNextPanelsUrl: () => {
    const panels = {};
    Object.keys(Comic.panels).forEach((pos) => {
      if (!Comic.lockedPanels.includes(pos) && RandomPanels.panels[pos]) {
        panels[pos] = RandomPanels.panels[pos];
      } else {
        panels[pos] = Comic.panels[pos];
      }
    });

    return Url.setPanels(panels);
  },
};

module.exports = ReloadButton;
