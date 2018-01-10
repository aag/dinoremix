const m = require('mithril');

const NumPanelsButton = {
  view: (vnode) => {
    const { chosen, num } = vnode.attrs;

    const chosenClass = chosen ? 'chosenPanelNumLink' : 'unchosenPanelNumLink';
    return m('a', { class: `panelNumLink ${chosenClass}` }, num);
  },
};

module.exports = NumPanelsButton;
