global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const NumPanelsButton = require('../NumPanelsButton');

o.spec('The NumPanelsButton component', () => {
  o('renders the button', () => {
    const output = mq(NumPanelsButton, { num: 3 });
    output.should.have('.NumPanelsButton');
    output.should.contain('3');
  });
});
