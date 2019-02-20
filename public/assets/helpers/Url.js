const m = require('mithril');

const PanelPositions = require('./PanelPositions');

const Url = {
  getQueryString: () => {
    if (window && window.location && window.location.search) {
      return window.location.search;
    }

    return '';
  },

  setQueryParam: (name, value, queryString) => {
    const currentQueryString = queryString || Url.getQueryString();

    const qsObject = m.parseQueryString(currentQueryString);
    if (value) {
      qsObject[name] = value;
    } else {
      delete qsObject[name];
    }

    const newQueryString = m.buildQueryString(qsObject);
    if (newQueryString) {
      return `?${newQueryString}`;
    }

    return '';
  },

  setPanels: (panels) => {
    let queryString = Url.getQueryString();

    Object.entries(panels).forEach((entry) => {
      queryString = Url.setQueryParam(entry[0], entry[1], queryString);
    });

    return queryString;
  },

  getQueryParam: (name) => {
    const currentQueryString = Url.getQueryString();

    const qsObject = m.parseQueryString(currentQueryString);
    return qsObject[name];
  },

  togglePanel: (pos) => {
    const lockedPanelsString = Url.getQueryParam('locked');
    if (!lockedPanelsString) {
      return Url.setQueryParam('locked', pos);
    }

    let lockedPanels = lockedPanelsString.split('-');
    if (lockedPanels.includes(pos)) {
      lockedPanels = lockedPanels.filter(panel => panel !== pos);
    } else {
      lockedPanels.push(pos);
    }

    lockedPanels.sort();

    return Url.setQueryParam('locked', lockedPanels.join('-'));
  },

  isPanelLocked: (pos) => {
    const lockedPanelsString = Url.getQueryParam('locked');
    if (!lockedPanelsString) {
      return false;
    }

    return lockedPanelsString.split('-').includes(pos);
  },

  getLockedPanels: () => {
    let lockedPanels = [];

    const lockedPanelsString = Url.getQueryParam('locked');
    if (lockedPanelsString) {
      lockedPanels = lockedPanelsString.split('-');
    }

    return lockedPanels;
  },

  getImageUrl: (pos, id) => {
    if (!pos || !id) {
      return '';
    }

    const { directory } = PanelPositions[pos];
    return `/panels/${directory}/comic2-${id}-${directory}.png`;
  },
};

module.exports = Url;
