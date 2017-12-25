const m = require('mithril');

const Permalink = require('./Permalink');

class ComicUI {
  static view() {
    return m('.comic', [
      m(Permalink),
    ]);
  }
}

module.exports = ComicUI;
