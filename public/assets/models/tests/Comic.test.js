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

  o.spec('getNextPanelsLink works', () => {
    o.beforeEach(() => {
      Comic.panels = {
        tl: '101',
        tm: '102',
        tr: '103',
        bl: '104',
        bm: '105',
        br: '106',
      };

      Comic.nextPanels = {
        tl: '201',
        tm: '202',
        tr: '203',
        bl: '204',
        bm: '205',
        br: '206',
      };
    });

    o('with all locked panels', () => {
      window.location.search = '?locked=tl-tm-tr-bl-bm-br';
      o(Comic.getNextPanelsLink())
        .equals('?locked=tl-tm-tr-bl-bm-br&tl=101&tm=102&tr=103&bl=104&bm=105&br=106');
    });

    o('with no locked panels', () => {
      o(Comic.getNextPanelsLink())
        .equals('?tl=201&tm=202&tr=203&bl=204&bm=205&br=206');
    });

    o('with some locked panels', () => {
      window.location.search = '?locked=tm-bl-br';
      o(Comic.getNextPanelsLink())
        .equals('?locked=tm-bl-br&tl=201&tm=102&tr=203&bl=104&bm=205&br=106');
    });

    o('with missing nextPanel entries', () => {
      Comic.nextPanels = {};
      o(Comic.getNextPanelsLink())
        .equals('?tl=101&tm=102&tr=103&bl=104&bm=105&br=106');
    });
  });

  o.spec('loadPanelsFromUrl works', () => {
    o.beforeEach(() => {
      Comic.panels = {
        tl: '101',
        tm: '102',
        tr: '103',
        bl: '104',
        bm: '105',
        br: '106',
      };
    });

    o('with no panels in the URL', () => {
      o(Comic.getNextPanelsLink()).equals('?tl=101&tm=102&tr=103&bl=104&bm=105&br=106');
    });
  });
});
