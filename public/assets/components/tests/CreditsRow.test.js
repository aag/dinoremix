global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const CreditsRow = require('../CreditsRow');

o.spec('The CreditRow component', () => {
  o('renders the left and right credit images', () => {
    const output = mq(CreditsRow, { numPanels: 2 });
    output.should.have(2, 'img');
  });
});