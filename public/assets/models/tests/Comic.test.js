const o = require('mithril/ospec/ospec');

global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const Comic = require('../Comic');

o.spec('getCurrentComicForPanel', () => {
  o('default works', () => {
    o(Comic.getCurrentComicForPanel('tl')).equals('100');
  });
});
