const m = require('mithril');
const UrlUpdater = require('../helpers/UrlUpdater');

const NumPanelsButton = {
  view: (vnode) => {
    const { chosen, num } = vnode.attrs;

    const chosenClass = chosen ? 'chosenPanelNumLink' : 'unchosenPanelNumLink';
    return m('a', {
      href: UrlUpdater.updateQueryParam('numpanels', num),
      class: `panelNumLink ${chosenClass}`,
      oncreate: m.route.link,
    }, num);
  },
};

module.exports = NumPanelsButton;
