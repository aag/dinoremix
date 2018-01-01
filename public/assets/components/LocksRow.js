const m = require('mithril');

const LocksRow = {
  getVisibleLocks: (position, numPanels) => {
    if (position === 'top') {
      switch (numPanels) {
        case 2:
          return ['tl', 'br'];
        case 3:
          return ['tl', 'tm', 'br'];
        case 6:
          return ['tl', 'tm', 'tr'];
        default:
          return [];
      }
    }

    // position: bottom
    if (numPanels === 6) {
      return ['bl', 'bm', 'br'];
    }

    return [];
  },

  view: (vnode) => {
    const numPanels = vnode.attrs.numPanels ? vnode.attrs.numPanels : 3;
    const { position } = vnode.attrs;

    const children = vnode.state.getVisibleLocks(position, numPanels)
      .map(pos => m(
        'div',
        { class: `${pos}Lock unlockedLock lockHolder` },
        m('img', { src: 'images/lock_open.png', alt: 'Click to lock' }),
      ));

    return m('div', { class: `${position}Locks clearfix` }, children);
  },
};

module.exports = LocksRow;
