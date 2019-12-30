const o = require('ospec');

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

  o.spec('allPanelsLocked()', () => {
    o('when all are unlocked', () => {
      Comic.lockedPanels = [];

      o(Comic.allPanelsLocked()).equals(false);
    });

    o('when some are unlocked', () => {
      Comic.lockedPanels = ['tl', 'br'];

      o(Comic.allPanelsLocked()).equals(false);
    });

    o('when all are locked', () => {
      Comic.lockedPanels = ['tl', 'tm', 'tr', 'bl', 'bm', 'br'];

      o(Comic.allPanelsLocked()).equals(true);
    });
  });
});
