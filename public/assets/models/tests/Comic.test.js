global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const Comic = require('../Comic');

o.spec('The Comic model', () => {
  o.spec('getCurrentComicForPanel', () => {
    o('returns the correct comic number', () => {
      Comic.panels.tl = 'comic2-101-topleft.png';

      o(Comic.getCurrentComicForPanel('tl')).equals('101');
    });

    o('returns the correct comic number after updates', () => {
      Comic.panels.tr = 'comic2-111-topright.png';
      o(Comic.getCurrentComicForPanel('tr')).equals('111');

      Comic.panels.tr = 'comic2-999-topright.png';
      o(Comic.getCurrentComicForPanel('tr')).equals('999');
    });
  });

  o('getPermalink works', () => {
    Comic.numPanels = 3;
    Comic.panels = {
      tl: 'comic2-101-topleft.png',
      tm: 'comic2-102-topmiddle.png',
      tr: 'comic2-103-topright.png',
      bl: 'comic2-104-bottomleft.png',
      bm: 'comic2-105-bottommiddle.png',
      br: 'comic2-106-bottomright.png',
    };

    o(Comic.getPermalink()).equals('?numPanels=3&tl=101&tm=102&tr=103&bl=104&bm=105&br=106');
  });
});
