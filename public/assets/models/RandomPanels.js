const m = require('mithril');

const RandomPanels = {
  panels: {},

  load: () => m.request({
    method: 'GET',
    url: '/api/images/random',
  })
    .then((result) => {
      result.forEach((panel) => {
        RandomPanels[panel.pos] = panel.id;
      });
    }),
};

module.exports = RandomPanels;
