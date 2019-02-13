global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const Comic = require('../../models/Comic');
const ComicUI = require('../ComicUI');

// Stub out the XHR request
Comic.loadNextPanels = () => {};

o.spec('The ComicUI component', () => {
  o('renders the comic', () => {
    const output = mq(ComicUI);
    output.should.have('.comic');
  });

  o('renders the num panels switcher permalink', () => {
    const output = mq(ComicUI);
    output.should.have('#panelNumSwitcher');
  });

  o('renders a permalink', () => {
    const output = mq(ComicUI);
    output.should.have('#permaLink');
  });

  o('renders the credits', () => {
    const output = mq(ComicUI);
    output.should.have('.creditsRow');
  });

  o('renders the reload button', () => {
    const output = mq(ComicUI);
    output.should.have('#reloadButton');
  });
});
