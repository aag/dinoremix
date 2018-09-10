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
      window.location.search = 'param=yes';
      o(Url.setQueryParam('numPanels', 3)).equals('?param=yes&numPanels=3');
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
});
