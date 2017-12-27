const m = require('mithril');

const Permalink = require('./Permalink');

const ComicUI = {
  view: () =>
    m(
      '.comic', [
        m(Permalink),
      ]),
}

module.exports = ComicUI;
