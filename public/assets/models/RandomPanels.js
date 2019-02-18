const m = require('mithril');

const RandomPanels = {
  panels: {},

  loadFromGlobal: () => {
    if (window.dr && window.dr.nextPanels) {
      RandomPanels.panels = window.dr.nextPanels;
    }
  },

  fetchFromServer: () => m.request({
    method: 'GET',
    url: '/api/images/random',
  })
    .then((result) => {
      result.forEach((panel) => {
        RandomPanels.panels[panel.pos] = panel.id;
      });
    }),
};

module.exports = RandomPanels;
