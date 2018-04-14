const m = require('mithril');

const CreditsRow = {
  view: () => m('.creditsRow', [
    m('img.lCredit', { src: 'panels/credits_left.png', alt: 'Copyright 2008-2018 Ryan North' }),
    m('img.rCredit', { src: 'panels/credits_right.png', alt: 'www.quantz.com' }),
  ]),
};

module.exports = CreditsRow;
