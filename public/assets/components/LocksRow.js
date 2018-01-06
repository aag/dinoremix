const m = require('mithril');

const ComicLayout = require('../helpers/ComicLayout');

const LocksRow = {
  view: (vnode) => {
    const numPanels = vnode.attrs.numPanels ? vnode.attrs.numPanels : 3;
    const { position } = vnode.attrs;

    const children = ComicLayout.getVisibleLocks(position, numPanels)
      .map(pos => m(
        'div',
        { class: `${pos}Lock unlockedLock lockHolder` },
        m('img', { src: 'images/lock_open.png', alt: 'Click to lock' }),
      ));

    return m('div', { class: `${position}Locks clearfix` }, children);
  },
};

module.exports = LocksRow;
