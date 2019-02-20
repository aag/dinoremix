const m = require('mithril');

const NumPanelsButton = require('./NumPanelsButton');

const NumPanelsSwitcher = {
  view: (vnode) => {
    const { numPanels } = vnode.attrs;

    return m('.NumPanelsWrapper', [
      'Number of panels: ',
      m('span.NumPanelsSwitcher', [
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
