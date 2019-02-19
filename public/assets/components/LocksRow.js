const m = require('mithril');

const ComicLayout = require('../helpers/ComicLayout');
const Url = require('../helpers/Url');

const LocksRow = {
  view: (vnode) => {
    const { position, numPanels } = vnode.attrs;

    const children = ComicLayout.getVisibleLocks(position, numPanels)
      .map(pos => LocksRow.createLockNode(pos));

    return m('.LocksRow', children);
  },

  createLockNode: (pos) => {
    const lockedClass = Url.isPanelLocked(pos) ? 'Lock__button--locked' : 'Lock__button--unlocked';

    return m('a.Lock', { href: Url.togglePanel(pos), oncreate: m.route.link },
      m('div', { class: `Lock__button Lock__button--${pos} ${lockedClass}` },
        m('img', { src: 'images/lock_open.png', alt: 'Click to lock' })));
  },
};

module.exports = LocksRow;
