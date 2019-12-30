var o = require('ospec');
var jsdom = require('jsdom');
var dom = new jsdom.JSDOM('', {
  // So we can get `requestAnimationFrame`
  pretendToBeVisual: true,
});

// Fill in the globals Mithril needs to operate. Also, the first two are often
// useful to have just in tests.
global.window = dom.window;
global.document = dom.window.document;
global.requestAnimationFrame = dom.window.requestAnimationFrame;

// Require Mithril to make sure it loads properly.
require('mithril');

// And now, make sure JSDOM ends when the tests end.
o.after(function() {
  dom.window.close();
});
