global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const Panels = require('../Panels');

o.spec('The Panels component', () => {
  o('renders correctly', () => {
    const output = mq(Panels, {
      images: {
        tl: 'comic2-100-topleft.png',
        tm: 'comic2-101-topmiddle.png',
        tr: 'comic2-102-topright.png',
        bl: 'comic2-103-bottomleft.png',
        bm: 'comic2-104-bottommiddle.png',
        br: 'comic2-105-bottomright.png',
      },
    });
    output.should.have('#panelContainer');
    output.should.have('#tlImage[src="/panels/topleft/comic2-100-topleft.png"]');
  });
});

