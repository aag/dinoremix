const m = require('mithril');

const NumPanelsButton = require('./NumPanelsButton');

const NumPanelsSwitcher = {
  view: () =>
    m('#numPanelsHolder', [
      'Number of panels: ',
      m('span#panelNumSwitcher', [
        m(NumPanelsButton, { num: 2, chosen: false }),
        ' ',
        m(NumPanelsButton, { num: 3, chosen: true }),
        ' ',
        m(NumPanelsButton, { num: 6, chosen: false }),
      ]),
    ]),
};

module.exports = NumPanelsSwitcher;
