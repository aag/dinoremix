const m = require('mithril');

const Comic = require('../models/Comic');

class Permalink {
  static view() {
    return m(
      '#permalinkHolder',
      m('a', { id: 'permaLink', href: Comic.getPermalink() }, [
        m('img', { src: '/images/link.png', alt: 'Link' }),
        ' ',
        m('span', { class: 'permaLinkText' }, 'Permalink to this remix'),
      ]),
    );
  }
}

module.exports = Permalink;
