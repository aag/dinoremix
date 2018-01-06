const o = require('mithril/ospec/ospec');

const ComicLayout = require('../ComicLayout');

o.spec('ComicLayout.getVisibleLocks()', () => {
  o('returns an empty array for invalid inputs', () => {
    o(ComicLayout.getVisibleLocks('', 3)).deepEquals([]);
    o(ComicLayout.getVisibleLocks('left', 3)).deepEquals([]);
    o(ComicLayout.getVisibleLocks('top', '')).deepEquals([]);
    o(ComicLayout.getVisibleLocks('top', 5)).deepEquals([]);
  });

  o('returns the correct locations for the top row', () => {
    o(ComicLayout.getVisibleLocks('top', 2)).deepEquals(['tl', 'br']);
    o(ComicLayout.getVisibleLocks('top', 3)).deepEquals(['tl', 'tm', 'br']);
    o(ComicLayout.getVisibleLocks('top', 6)).deepEquals(['tl', 'tm', 'tr']);
  });

  o('returns the correct locations for the bottom row', () => {
    o(ComicLayout.getVisibleLocks('bottom', 2)).deepEquals([]);
    o(ComicLayout.getVisibleLocks('bottom', 3)).deepEquals([]);
    o(ComicLayout.getVisibleLocks('bottom', 6)).deepEquals(['bl', 'bm', 'br']);
  });
});

