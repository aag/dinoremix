const m = require('mithril');

const Url = {
  getQueryString: () => {
    if (window && window.location && window.location.search) {
      return window.location.search;
    }

    return '';
  },

  setQueryParam: (name, value) => {
    const currentQueryString = Url.getQueryString();

    const qsObject = m.parseQueryString(currentQueryString);
    if (value) {
      qsObject[name] = value;
    } else {
      delete qsObject[name];
    }

    const queryString = m.buildQueryString(qsObject);
    if (queryString) {
      return `?${queryString}`;
    }

    return '';
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
};

module.exports = Url;
