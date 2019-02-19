const m = require('mithril');
const Url = require('../helpers/Url');

const NumPanelsButton = {
  view: (vnode) => {
    const { chosen, num } = vnode.attrs;

    const chosenClass = chosen ? 'NumPanelsButton--chosen' : 'NumPanelsButton--unchosen';
    return m('a.NumPanelsButton', {
      href: Url.setQueryParam('numpanels', num),
      class: `${chosenClass}`,
      oncreate: m.route.link,
    }, num);
  },
};

module.exports = NumPanelsButton;
