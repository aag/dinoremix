const mq = require('mithril-query');
const o = require('ospec');

const AltTextEditor = require('../AltTextEditor');

o.spec('The AltTextEditor component', () => {
  o('renders the editor', () => {
    const output = mq(AltTextEditor, { showButton: true });
    output.should.have('.AltTextEditor');
  });
});
