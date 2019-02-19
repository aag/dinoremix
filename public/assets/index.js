import m from 'mithril';

/* eslint-disable no-unused-vars */
import sass from './sass/main.scss';
/* eslint-enable no-unused-vars */

import ComicUI from './components/ComicUI';

m.route.prefix('');

m.route(document.querySelector('.comic-wrapper'), '/', {
  '/': ComicUI,
});
