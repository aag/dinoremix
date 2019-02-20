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
    const lockedClass = Url.isPanelLocked(pos) ? 'Lock--locked' : 'Lock--unlocked';

    return m('a.Lock', {
      href: Url.togglePanel(pos),
      oncreate: m.route.link,
      class: `Lock--${pos} ${lockedClass}`,
    });
  },
};

module.exports = LocksRow;
