const mq = require('mithril-query');
const o = require('ospec');

const LocksRow = require('../LocksRow');
const Url = require('../../helpers/Url');

o.spec('The LocksRow component', () => {
  o.beforeEach(() => {
    Url.getQueryString = () => '';
  });

  o('renders the top row locks for 2 panels', () => {
    const output = mq(LocksRow, { position: 'top', numPanels: 2 });
    output.should.have(['.Lock--tl', '.Lock--br']);

    output.should.not.have('.Lock--tr');
    output.should.not.have('.Lock--tm');
    output.should.not.have('.Lock--bl');
    output.should.not.have('.Lock--bm');
  });

  o('renders the top row locks for 3 panels', () => {
    const output = mq(LocksRow, { position: 'top', numPanels: 3 });
    output.should.have(['.Lock--tl', '.Lock--tm', '.Lock--br']);

    output.should.not.have('.Lock--tr');
    output.should.not.have('.Lock--bl');
    output.should.not.have('.Lock--bm');
  });

  o('renders the top row locks for 6 panels', () => {
    const output = mq(LocksRow, { position: 'top', numPanels: 6 });
    output.should.have(['.Lock--tl', '.Lock--tm', '.Lock--tr']);

    output.should.not.have('.Lock--bl');
    output.should.not.have('.Lock--bm');
    output.should.not.have('.Lock--br');
  });

  o('renders no bottom row locks for 2 panels', () => {
    const output = mq(LocksRow, { position: 'bottom', numPanels: 2 });

    output.should.not.have('.Lock--tl');
    output.should.not.have('.Lock--tm');
    output.should.not.have('.Lock--tr');
    output.should.not.have('.Lock--bl');
    output.should.not.have('.Lock--bm');
    output.should.not.have('.Lock--br');
  });

  o('renders the bottom row locks for 3 panels', () => {
    const output = mq(LocksRow, { position: 'bottom', numPanels: 3 });

    output.should.not.have('.Lock--tl');
    output.should.not.have('.Lock--tm');
    output.should.not.have('.Lock--tr');
    output.should.not.have('.Lock--bl');
    output.should.not.have('.Lock--bm');
    output.should.not.have('.Lock--br');
  });

  o('renders the bottom row locks for 6 panels', () => {
    const output = mq(LocksRow, { position: 'bottom', numPanels: 6 });
    output.should.have(['.Lock--bl', '.Lock--bm', '.Lock--br']);

    output.should.not.have('.Lock--tl');
    output.should.not.have('.Lock--tm');
    output.should.not.have('.Lock--tr');
  });

  o('renders locked top panels as locked', () => {
    Url.getQueryString = () => '?locked=tl-tm-bm';
    const output = mq(LocksRow, { position: 'top', numPanels: 6 });
    output.should.have(['.Lock--tl.Lock--locked', '.Lock--tm.Lock--locked']);
    output.should.not.have('.Lock--tr.Lock--lockedLock');
  });

  o('renders locked bottom panels as locked', () => {
    Url.getQueryString = () => '?locked=tl-tm-bm';
    const output = mq(LocksRow, { position: 'bottom', numPanels: 6 });
    output.should.have('.Lock--bm.Lock--locked');
    output.should.not.have('.Lock--bl.Lock--locked');
    output.should.not.have('.Lock--br.Lock--locked');
  });
});
