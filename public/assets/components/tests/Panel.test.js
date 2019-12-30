const mq = require('mithril-query');
const o = require('ospec');

const Panel = require('../Panel');

o.spec('The Panel component', () => {
  o('renders correctly', () => {
    const output = mq(Panel, {
      position: 'tl',
      src: '/images/comic-1.png',
      altText: 'alt text',
    });
    output.should.have('img.Panel.Panel--tl[src="/images/comic-1.png"]');
    output.should.have('.Panel[alt="alt text"]');
    output.should.have('.Panel[title="alt text"]');
  });
});
