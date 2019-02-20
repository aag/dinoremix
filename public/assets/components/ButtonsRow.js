const m = require('mithril');

const ReloadButton = require('./ReloadButton');
const NumPanelsSwitcher = require('./NumPanelsSwitcher');

const ButtonsRow = {
  view: (vnode) => {
    const { numPanels } = vnode.attrs;

    return m('.ButtonsRow', [
      m(ReloadButton),
      m(NumPanelsSwitcher, { numPanels }),
    ]);
  },
};

module.exports = ButtonsRow;
