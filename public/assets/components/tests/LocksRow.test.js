global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const LocksRow = require('../LocksRow');

o.spec('The LocksRow component', () => {
  o('renders the top row locks for the default number of panels', () => {
    const output = mq(LocksRow, { position: 'top' });
    output.should.have(['.topLocks', '.tlLock', '.tmLock', '.brLock']);

    output.should.not.have('.trLock');
    output.should.not.have('.blLock');
    output.should.not.have('.bmLock');
  });

  o('renders the top row locks for 2 panels', () => {
    const output = mq(LocksRow, { position: 'top', numPanels: 2 });
    output.should.have(['.topLocks', '.tlLock', '.brLock']);

    output.should.not.have('.trLock');
    output.should.not.have('.tmLock');
    output.should.not.have('.blLock');
    output.should.not.have('.bmLock');
  });

  o('renders the top row locks for 3 panels', () => {
    const output = mq(LocksRow, { position: 'top', numPanels: 3 });
    output.should.have(['.topLocks', '.tlLock', '.tmLock', '.brLock']);

    output.should.not.have('.trLock');
    output.should.not.have('.blLock');
    output.should.not.have('.bmLock');
  });

  o('renders the top row locks for 6 panels', () => {
    const output = mq(LocksRow, { position: 'top', numPanels: 6 });
    output.should.have(['.topLocks', '.tlLock', '.tmLock', '.trLock']);

    output.should.not.have('.blLock');
    output.should.not.have('.bmLock');
    output.should.not.have('.brLock');
  });

  o('renders no bottom row locks for 2 panels', () => {
    const output = mq(LocksRow, { position: 'bottom', numPanels: 2 });
    output.should.have('.bottomLocks');

    output.should.not.have('.tlLock');
    output.should.not.have('.tmLock');
    output.should.not.have('.trLock');
    output.should.not.have('.blLock');
    output.should.not.have('.bmLock');
    output.should.not.have('.brLock');
  });

  o('renders the bottom row locks for 3 panels', () => {
    const output = mq(LocksRow, { position: 'bottom', numPanels: 3 });
    output.should.have('.bottomLocks');

    output.should.not.have('.tlLock');
    output.should.not.have('.tmLock');
    output.should.not.have('.trLock');
    output.should.not.have('.blLock');
    output.should.not.have('.bmLock');
    output.should.not.have('.brLock');
  });

  o('renders the bottom row locks for 6 panels', () => {
    const output = mq(LocksRow, { position: 'bottom', numPanels: 6 });
    output.should.have(['.bottomLocks', '.blLock', '.bmLock', '.brLock']);

    output.should.not.have('.tlLock');
    output.should.not.have('.tmLock');
    output.should.not.have('.trLock');
  });
});

