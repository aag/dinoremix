const m = require('mithril');

const NumPanelsButton = require('./NumPanelsButton');

const NumPanelsSwitcher = {
  view: (vnode) => {
    const numPanels = vnode.attrs.numPanels ? vnode.attrs.numPanels : 3;

    return m('#numPanelsHolder', [
      'Number of panels: ',
      m('span#panelNumSwitcher', [
        m(NumPanelsButton, { num: 2, chosen: numPanels === 2 }),
        ' ',
        m(NumPanelsButton, { num: 3, chosen: numPanels === 3 }),
        ' ',
        m(NumPanelsButton, { num: 6, chosen: numPanels === 6 }),
      ]),
    ]);
  },
};

module.exports = NumPanelsSwitcher;
