const m = require('mithril');

const Url = require('../helpers/Url');

const RandomPanels = {
  panels: {},
  images: [],

  loadFromGlobal: () => {
    if (window.dr && window.dr.nextPanels) {
      RandomPanels.panels = window.dr.nextPanels;
      RandomPanels.preloadImages();
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

      RandomPanels.preloadImages();
    }),

  preloadImages: () => {
    RandomPanels.images = [];

    Object.entries(RandomPanels.panels).forEach(([pos, id]) => {
      const image = new Image();
      image.src = Url.getImageUrl(pos, id);
      RandomPanels.images.push(image);
    });
  },
};

module.exports = RandomPanels;
