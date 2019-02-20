global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const Comic = require('../Comic');

o.spec('The Comic model', () => {
  o.beforeEach(() => {
    window.location.search = '';
  });

  o('getPermalink() works', () => {
    Comic.panels = {
      tl: '101',
      tm: '102',
      tr: '103',
      bl: '104',
      bm: '105',
      br: '106',
    };

    o(Comic.getPermalink()).equals('?tl=101&tm=102&tr=103&bl=104&bm=105&br=106');
  });
});
