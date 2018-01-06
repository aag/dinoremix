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
};

module.exports = ComicLayout;

