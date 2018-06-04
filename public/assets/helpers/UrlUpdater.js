const m = require('mithril');

const UrlUpdater = {
  getQueryString: () => {
    if (window && window.location && window.location.search) {
      return window.location.search;
    }

    return '';
  },

  updateQueryParam: (name, value) => {
    const currentQueryString = UrlUpdater.getQueryString();

    const qsObject = m.parseQueryString(currentQueryString);
    qsObject[name] = value;

    return `?${m.buildQueryString(qsObject)}`;
  },
};

module.exports = UrlUpdater;

