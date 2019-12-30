const mq = require('mithril-query');
const o = require('ospec');

const CreditsRow = require('../CreditsRow');

o.spec('The CreditRow component', () => {
  o('renders the left and right credit images', () => {
    const output = mq(CreditsRow, { numPanels: 2 });
    output.should.have(2, 'img');
  });
});
