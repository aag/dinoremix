const m = require('mithril');

const NumPanelsButton = {
  view: (vnode) => {
    const chosenClass = vnode.attrs.chosen ?
      'chosenPanelNumLink' :
      'unchosenPanelNumLink';
    return m('a', { class: `panelNumLink ${chosenClass}` }, vnode.attrs.num);
  },
};

module.exports = NumPanelsButton;
