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
    qsObject[name] = value;

    return `?${m.buildQueryString(qsObject)}`;
  },
};

module.exports = Url;
