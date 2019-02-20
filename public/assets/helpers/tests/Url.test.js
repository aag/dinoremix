global.window = require('mithril/test-utils/browserMock.js')();
const o = require('mithril/ospec/ospec');

const Url = require('../Url');

o.spec('Url', () => {
  o.beforeEach(() => {
    window.location.search = '';
  });

  o.spec('.getQueryString()', () => {
    o('returns an empty string if no query parameter exists', () => {
      o(Url.getQueryString()).equals('');
    });

    o('returns the current query string if it exists', () => {
      window.location.search = '?param=yes';
      o(Url.getQueryString()).equals('?param=yes');
    });
  });

  o.spec('.setQueryParam()', () => {
    o('adds a numPanels parameter if the query string is empty', () => {
      o(Url.setQueryParam('numPanels', 3)).equals('?numPanels=3');
    });

    o('adds a numPanels parameter if the query string has a different param', () => {
      window.location.search = '?param=yes';
      o(Url.setQueryParam('numPanels', 3)).equals('?param=yes&numPanels=3');
    });

    o('removes the numPanels parameter if the new value is empty', () => {
      window.location.search = '?param=yes&numPanels=3';
      o(Url.setQueryParam('numPanels', '')).equals('?param=yes');
    });

    o('removes the question mark if the last param is removed', () => {
      window.location.search = '?param=yes';
      o(Url.setQueryParam('param', '')).equals('');
    });

    o('updates the numPanels parameter if only it already exists', () => {
      window.location.search = '?numPanels=2';
      o(Url.setQueryParam('numPanels', 6)).equals('?numPanels=6');
    });

    o('updates the numPanels parameter if it and others already exist', () => {
      window.location.search = '?param=yes&numPanels=2';
      o(Url.setQueryParam('numPanels', 6)).equals('?param=yes&numPanels=6');
    });
  });

  o.spec('.getQueryParam()', () => {
    o('returns the correct value if the param is set', () => {
      window.location.search = '?numPanels=2';
      o(Url.getQueryParam('numPanels')).equals('2');
    });

    o('returns undefined if the param is not set', () => {
      window.location.search = '?numPanels=2';
      o(Url.getQueryParam('newParam')).equals(undefined);
    });
  });

  o.spec('.togglePanel()', () => {
    o('adds locked param if none are currently locked', () => {
      window.location.search = '';
      o(Url.togglePanel('tl')).equals('?locked=tl');
    });

    o('removes locked param if the given panel is the last locked one', () => {
      window.location.search = '?locked=br';
      o(Url.togglePanel('br')).equals('');
    });

    o('adds panel if given panel is unlocked', () => {
      window.location.search = '?locked=bl';
      o(Url.togglePanel('tm')).equals('?locked=bl-tm');
    });

    o('removes panel if given panel is already locked', () => {
      window.location.search = '?locked=br-tl';
      o(Url.togglePanel('br')).equals('?locked=tl');
    });
  });

  o.spec('.isPanelLocked()', () => {
    o('returns false if no panels are currently locked', () => {
      window.location.search = '';
      o(Url.isPanelLocked('tl')).equals(false);
    });

    o('returns false if given panel is not currently locked', () => {
      window.location.search = '?locked=tl-tm';
      o(Url.isPanelLocked('tr')).equals(false);
    });

    o('returns true if given panel is currently locked', () => {
      window.location.search = '?locked=tl-tm';
      o(Url.isPanelLocked('tm')).equals(true);
    });
  });

  o.spec('.getImageUrl()', () => {
    o('returns an empty string for an empty argument', () => {
      o(Url.getImageUrl('', '')).equals('');
    });

    o('returns the correct path for a typical comic ID', () => {
      o(Url.getImageUrl('bl', '100')).equals('/panels/bottomleft/comic2-100-bottomleft.png');
    });
  });
});
