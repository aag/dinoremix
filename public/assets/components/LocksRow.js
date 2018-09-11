const m = require('mithril');

const ComicLayout = require('../helpers/ComicLayout');
const Url = require('../helpers/Url');

const LocksRow = {
  view: (vnode) => {
    const { position, numPanels } = vnode.attrs;

    const children = ComicLayout.getVisibleLocks(position, numPanels)
      .map(pos => LocksRow.createLockNode(pos));

    return m('div', { class: `${position}Locks clearfix` }, children);
  },

  createLockNode: (pos) => {
    const lockedClass = Url.isPanelLocked(pos) ? 'lockedLock' : 'unlockedLock';

    return m('a', { href: Url.togglePanel(pos), oncreate: m.route.link },
      m('div', { class: `${pos}Lock ${lockedClass} lockHolder` },
        m('img', { src: 'images/lock_open.png', alt: 'Click to lock' })));
  },
};

module.exports = LocksRow;
