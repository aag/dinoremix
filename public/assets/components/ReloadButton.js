const m = require('mithril');

const ReloadButton = {
  view: () => m(
    'a#reloadLink', { href: './' },
    m('span#reloadButton', { class: 'unpressedReloadButton' }, [
      m('img', { src: '/images/reload.png', alt: 'Reload' }),
      ' ',
      m('span#reloadText', 'Reload the unlocked panels'),
    ]),
  ),
};

module.exports = ReloadButton;
