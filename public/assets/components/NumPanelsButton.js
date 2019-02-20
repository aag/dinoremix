const m = require('mithril');
const Url = require('../helpers/Url');

const NumPanelsButton = {
  view: (vnode) => {
    const { chosen, num } = vnode.attrs;

    const chosenClass = chosen ? 'Button--pressed' : '';
    return m('a.NumPanelsButton', {
      href: Url.setQueryParam('numpanels', num),
      class: `Button ${chosenClass}`,
      oncreate: m.route.link,
    }, num);
  },
};

module.exports = NumPanelsButton;
