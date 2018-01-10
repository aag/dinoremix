const m = require('mithril');

const NumPanelsButton = require('./NumPanelsButton');

const NumPanelsSwitcher = {
  view: (vnode) => {
    const { numPanels, onNumPanelsChanged } = vnode.attrs;

    return m('#numPanelsHolder', [
      'Number of panels: ',
      m('span#panelNumSwitcher', [
        m(NumPanelsButton, { num: 2, chosen: numPanels === 2, onNumPanelsChanged }),
        ' ',
        m(NumPanelsButton, { num: 3, chosen: numPanels === 3, onNumPanelsChanged }),
        ' ',
        m(NumPanelsButton, { num: 6, chosen: numPanels === 6, onNumPanelsChanged }),
      ]),
    ]);
  },
};

module.exports = NumPanelsSwitcher;
