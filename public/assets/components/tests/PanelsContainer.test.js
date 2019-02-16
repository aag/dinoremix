global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const PanelsContainer = require('../PanelsContainer');

o.spec('The PanelsContainer component', () => {
  o('renders correctly', () => {
    const output = mq(PanelsContainer, {
      altText: '',
      panels: {
        tl: '100',
        tm: '101',
        tr: '102',
        bl: '103',
        bm: '104',
        br: '105',
      },
      numPanels: 6,
    });
    output.should.have('#panelContainer');
    output.should.have('#tlImage[src="/panels/topleft/comic2-100-topleft.png"]');
  });
});
