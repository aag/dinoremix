const m = require('mithril');

const CreditsRow = {
  view: () => m('.CreditsRow', [
    m('img', { src: 'panels/credits_left.png', alt: '(C) 2008-2018 Ryan North' }),
    m('img', { src: 'panels/credits_right.png', alt: 'www.quantz.com' }),
  ]),
};

module.exports = CreditsRow;
