global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const ReloadButton = require('../ReloadButton');
const Comic = require('../../models/Comic');

// Stub out the XHR request
Comic.loadNextPanels = () => {};

o.spec('The ReloadButton component', () => {
  o('renders correctly', () => {
    const output = mq(ReloadButton);
    output.should.have('a#reloadLink');
    output.should.have('#reloadButton.unpressedReloadButton');
    output.should.contain('Reload the unlocked panels');
  });
});
