global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const NumPanelsSwitcher = require('../NumPanelsSwitcher');

o.spec('The NumPanelsSwitcher component', () => {
  o('renders the switcher', () => {
    const output = mq(NumPanelsSwitcher);
    output.should.have('#panelNumSwitcher');
  });
});

