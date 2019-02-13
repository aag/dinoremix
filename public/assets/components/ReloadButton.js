const m = require('mithril');

const Comic = require('../models/Comic');

const ReloadButton = {
  oninit: () => Comic.loadNextPanels(),
  onupdate: () => {
    if (Comic.getPermalink() === Comic.getNextPanelsLink()) {
      Comic.loadNextPanels();
    }
  },
  view: () => m(
    'a#reloadLink', { href: Comic.getNextPanelsLink(), oncreate: m.route.link },
    m('span#reloadButton', { class: 'unpressedReloadButton' }, [
      m('img', { src: '/images/reload.png', alt: 'Reload' }),
      ' ',
      m('span#reloadText', 'Reload the unlocked panels'),
    ]),
  ),
};

module.exports = ReloadButton;
