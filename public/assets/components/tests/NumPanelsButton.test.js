global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const NumPanelsButton = require('../NumPanelsButton');

o.spec('The NumPanelsButton component', () => {
  o('renders the button', () => {
    const output = mq(NumPanelsButton, { num: 3 });
    output.should.have('.panelNumLink');
    output.should.contain('3');
  });

  o('calls onNumPanelsChanged with the correct number when clicked', () => {
    let changedTo = -1;
    function changeHandler(num) { changedTo = num; }

    const output = mq(NumPanelsButton, { num: 3, onNumPanelsChanged: changeHandler });
    output.click('.panelNumLink');

    o(changedTo).equals(3);
  });
});

