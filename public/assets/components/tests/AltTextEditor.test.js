global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const AltTextEditor = require('../AltTextEditor');

o.spec('The AltTextEditor component', () => {
  o('renders the editor', () => {
    const output = mq(AltTextEditor, { altText: 'test text' });
    output.should.have('.AltTextEditor');
  });
});
