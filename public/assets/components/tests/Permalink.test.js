global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const Permalink = require('../Permalink');

o.spec('The Permalink component', () => {
  o('renders correctly', () => {
    const output = mq(Permalink, { url: '/link/to/comic' });
    output.should.have('a.Permalink[href="/link/to/comic"]');
    output.should.contain('Permalink to this remix');
  });
});
