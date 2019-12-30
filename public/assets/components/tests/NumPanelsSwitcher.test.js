const mq = require('mithril-query');
const o = require('ospec');

const NumPanelsSwitcher = require('../NumPanelsSwitcher');

o.spec('The NumPanelsSwitcher component', () => {
  o('renders the switcher', () => {
    const output = mq(NumPanelsSwitcher, { numPanels: 3 });
    output.should.have('.NumPanelsSwitcher');
  });

  o('allows selecting 2 panels', () => {
    const output = mq(NumPanelsSwitcher, { numPanels: 2 });
    output.should.have('.Button.Button--pressed:contains(2)');
    output.should.have('.Button:contains(3)');
    output.should.have('.Button:contains(6)');
  });

  o('allows selecting 3 panels', () => {
    const output = mq(NumPanelsSwitcher, { numPanels: 3 });
    output.should.have('.Button:contains(2)');
    output.should.have('.Button.Button--pressed:contains(3)');
    output.should.have('.Button:contains(6)');
  });

  o('allows selecting 6 panels', () => {
    const output = mq(NumPanelsSwitcher, { numPanels: 6 });
    output.should.have('.Button:contains(2)');
    output.should.have('.Button:contains(3)');
    output.should.have('.Button.Button--pressed:contains(6)');
  });
});
