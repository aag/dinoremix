const mq = require('mithril-query');
const o = require('ospec');

const ComicUI = require('../ComicUI');
const RandomPanels = require('../../models/RandomPanels');

// Stub out the XHR request
RandomPanels.fetchFromServer = () => {};

o.spec('The ComicUI component', () => {
  o('renders the comic', () => {
    const output = mq(ComicUI);
    output.should.have('.Comic');
  });

  o('renders the num panels switcher permalink', () => {
    const output = mq(ComicUI);
    output.should.have('.NumPanelsSwitcher');
  });

  o('renders a permalink', () => {
    const output = mq(ComicUI);
    output.should.have('.Permalink');
  });

  o('renders the credits', () => {
    const output = mq(ComicUI);
    output.should.have('.CreditsRow');
  });

  o('renders the reload button', () => {
    const output = mq(ComicUI);
    output.should.have('.ReloadButton');
  });
});
