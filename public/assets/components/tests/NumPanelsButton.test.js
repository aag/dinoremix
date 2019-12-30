const mq = require('mithril-query');
const o = require('ospec');

const NumPanelsButton = require('../NumPanelsButton');

o.spec('The NumPanelsButton component', () => {
  o('renders the button', () => {
    const output = mq(NumPanelsButton, { num: 3 });
    output.should.have('.NumPanelsButton');
    output.should.contain('3');
  });
});
