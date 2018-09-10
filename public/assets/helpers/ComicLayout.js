const panels = {
  tl: { position: 'tl', directory: 'topleft' },
  tm: { position: 'tm', directory: 'topmiddle' },
  tr: { position: 'tr', directory: 'topright' },
  bl: { position: 'bl', directory: 'bottomleft' },
  bm: { position: 'bm', directory: 'bottommiddle' },
  br: { position: 'br', directory: 'bottomright' },
};

const ComicLayout = {
  getVisibleLocks: (position, numPanels) => {
    if (position === 'top') {
      switch (numPanels) {
        case 2:
          return ['tl', 'br'];
        case 3:
          return ['tl', 'tm', 'br'];
        case 6:
          return ['tl', 'tm', 'tr'];
        default:
          return [];
      }
    }

    // position: bottom
    if (numPanels === 6) {
      return ['bl', 'bm', 'br'];
    }

    return [];
  },

  getVisiblePanels: (numPanels) => {
    switch (numPanels) {
      case 2:
        return [panels.tl, panels.br];
      case 3:
        return [panels.tl, panels.tm, panels.br];
      case 6:
        return [panels.tl, panels.tm, panels.tr, panels.bl, panels.bm, panels.br];
      default:
        return [];
    }
  },
};

module.exports = ComicLayout;
