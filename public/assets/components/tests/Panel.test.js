global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const Panel = require('../Panel');

o.spec('The Panel component', () => {
  o('renders correctly', () => {
    const output = mq(Panel, {
      position: 'tl',
      src: '/images/comic-1.png',
      altText: 'alt text',
    });
    output.should.have('img#tlImage.panelImage[src="/images/comic-1.png"]');
    output.should.have('.panelImage[alt="alt text"]');
    output.should.have('.panelImage[title="alt text"]');
  });
});

