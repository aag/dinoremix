const m = require('mithril');

const ComicLayout = require('../helpers/ComicLayout');
const Url = require('../helpers/Url');

const LocksRow = {
  view: (vnode) => {
    const { position, numPanels } = vnode.attrs;

    const children = ComicLayout.getVisibleLocks(position, numPanels)
      .map((pos) => LocksRow.createLockNode(pos));

    if (children && children.length > 0) {
      return m('.LocksRow', children);
    }

    return null;
  },

  createLockNode: (pos) => {
    const lockedClass = Url.isPanelLocked(pos) ? 'Lock--locked' : 'Lock--unlocked';

    return m(m.route.Link, {
      href: Url.togglePanel(pos),
      class: `Lock Lock--${pos} ${lockedClass}`,
    });
  },
};

module.exports = LocksRow;
