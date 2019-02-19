global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const LocksRow = require('../LocksRow');

o.spec('The LocksRow component', () => {
  o.beforeEach(() => {
    window.location.search = '';
  });

  o('renders the top row locks for 2 panels', () => {
    const output = mq(LocksRow, { position: 'top', numPanels: 2 });
    output.should.have(['.Lock__button--tl', '.Lock__button--br']);

    output.should.not.have('.Lock__button--tr');
    output.should.not.have('.Lock__button--tm');
    output.should.not.have('.Lock__button--bl');
    output.should.not.have('.Lock__button--bm');
  });

  o('renders the top row locks for 3 panels', () => {
    const output = mq(LocksRow, { position: 'top', numPanels: 3 });
    output.should.have(['.Lock__button--tl', '.Lock__button--tm', '.Lock__button--br']);

    output.should.not.have('.Lock__button--tr');
    output.should.not.have('.Lock__button--bl');
    output.should.not.have('.Lock__button--bm');
  });

  o('renders the top row locks for 6 panels', () => {
    const output = mq(LocksRow, { position: 'top', numPanels: 6 });
    output.should.have(['.Lock__button--tl', '.Lock__button--tm', '.Lock__button--tr']);

    output.should.not.have('.Lock__button--bl');
    output.should.not.have('.Lock__button--bm');
    output.should.not.have('.Lock__button--br');
  });

  o('renders no bottom row locks for 2 panels', () => {
    const output = mq(LocksRow, { position: 'bottom', numPanels: 2 });

    output.should.not.have('.Lock__button--tl');
    output.should.not.have('.Lock__button--tm');
    output.should.not.have('.Lock__button--tr');
    output.should.not.have('.Lock__button--bl');
    output.should.not.have('.Lock__button--bm');
    output.should.not.have('.Lock__button--br');
  });

  o('renders the bottom row locks for 3 panels', () => {
    const output = mq(LocksRow, { position: 'bottom', numPanels: 3 });

    output.should.not.have('.Lock__button--tl');
    output.should.not.have('.Lock__button--tm');
    output.should.not.have('.Lock__button--tr');
    output.should.not.have('.Lock__button--bl');
    output.should.not.have('.Lock__button--bm');
    output.should.not.have('.Lock__button--br');
  });

  o('renders the bottom row locks for 6 panels', () => {
    const output = mq(LocksRow, { position: 'bottom', numPanels: 6 });
    output.should.have(['.Lock__button--bl', '.Lock__button--bm', '.Lock__button--br']);

    output.should.not.have('.Lock__button--tl');
    output.should.not.have('.Lock__button--tm');
    output.should.not.have('.Lock__button--tr');
  });

  o('renders locked top panels as locked', () => {
    window.location.search = 'locked=tl-tm-bm';
    const output = mq(LocksRow, { position: 'top', numPanels: 6 });
    output.should.have(['.Lock__button--tl.Lock__button--locked', '.Lock__button--tm.Lock__button--locked']);
    output.should.not.have('.Lock__button--tr.Lock__button--lockedLock');
  });

  o('renders locked bottom panels as locked', () => {
    window.location.search = 'locked=tl-tm-bm';
    const output = mq(LocksRow, { position: 'bottom', numPanels: 6 });
    output.should.have('.Lock__button--bm.Lock__button--locked');
    output.should.not.have('.Lock__button--bl.Lock__button--locked');
    output.should.not.have('.Lock__button--br.Lock__button--locked');
  });
});
