const m = require('mithril');
const Url = require('../helpers/Url');

const NumPanelsButton = {
  view: (vnode) => {
    const { chosen, num } = vnode.attrs;

    const chosenClass = chosen ? 'chosenPanelNumLink' : 'unchosenPanelNumLink';
    return m('a', {
      href: Url.setQueryParam('numpanels', num),
      class: `panelNumLink ${chosenClass}`,
      oncreate: m.route.link,
    }, num);
  },
};

module.exports = NumPanelsButton;
