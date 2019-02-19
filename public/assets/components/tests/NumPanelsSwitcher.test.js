global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const NumPanelsSwitcher = require('../NumPanelsSwitcher');

o.spec('The NumPanelsSwitcher component', () => {
  o('renders the switcher', () => {
    const output = mq(NumPanelsSwitcher, { numPanels: 3 });
    output.should.have('.NumPanelsSwitcher');
  });

  o('allows selecting 2 panels', () => {
    const output = mq(NumPanelsSwitcher, { numPanels: 2 });
    output.should.have('.NumPanelsButton--chosen:contains(2)');
    output.should.have('.NumPanelsButton--unchosen:contains(3)');
    output.should.have('.NumPanelsButton--unchosen:contains(6)');
  });

  o('allows selecting 3 panels', () => {
    const output = mq(NumPanelsSwitcher, { numPanels: 3 });
    output.should.have('.NumPanelsButton--unchosen:contains(2)');
    output.should.have('.NumPanelsButton--chosen:contains(3)');
    output.should.have('.NumPanelsButton--unchosen:contains(6)');
  });

  o('allows selecting 6 panels', () => {
    const output = mq(NumPanelsSwitcher, { numPanels: 6 });
    output.should.have('.NumPanelsButton--unchosen:contains(2)');
    output.should.have('.NumPanelsButton--unchosen:contains(3)');
    output.should.have('.NumPanelsButton--chosen:contains(6)');
  });
});
