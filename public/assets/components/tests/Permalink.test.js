global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const Permalink = require('../Permalink');

o.spec('The Permalink component', () => {
  o('renders correctly', () => {
    const output = mq(Permalink, { url: '/link/to/comic' } );
    output.should.have('#permalinkHolder');
    output.should.have('a#permaLink[href="/link/to/comic"]');
    output.should.have('img[src="/images/link.png"]');
    output.should.contain('Permalink to this remix');
  });
});

