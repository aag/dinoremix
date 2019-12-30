const m = require('mithril');
const Url = require('../helpers/Url');

const NumPanelsButton = {
  view: (vnode) => {
    const { chosen, num } = vnode.attrs;

    const chosenClass = chosen ? 'Button--pressed' : '';
    return m(m.route.Link, {
      href: Url.setQueryParam('numpanels', num),
      class: `Button NumPanelsButton ${chosenClass}`,
    }, num);
  },
};

module.exports = NumPanelsButton;
