const m = require('mithril');

const NumPanelsButton = {
  view: (vnode) => {
    const { chosen, num, onNumPanelsChanged } = vnode.attrs;

    const chosenClass = chosen ? 'chosenPanelNumLink' : 'unchosenPanelNumLink';
    return m('a', {
      class: `panelNumLink ${chosenClass}`,
      onclick: () => onNumPanelsChanged(num),
    }, num);
  },
};

module.exports = NumPanelsButton;
