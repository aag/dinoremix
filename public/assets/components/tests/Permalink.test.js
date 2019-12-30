const mq = require('mithril-query');
const o = require('ospec');

const Permalink = require('../Permalink');

o.spec('The Permalink component', () => {
  o('renders correctly', () => {
    const output = mq(Permalink, { url: '/link/to/comic' });
    output.should.have('a.Permalink[href="/link/to/comic"]');
    output.should.contain('Permalink to this remix');
  });
});
