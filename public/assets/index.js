import m from 'mithril';

/* eslint-disable no-unused-vars */
import reset from './reset.css';
import style from './dino.css';
/* eslint-enable no-unused-vars */

import ComicUI from './components/ComicUI';

m.route.prefix('');

m.route(document.querySelector('.comic-wrapper'), '/', {
  '/': ComicUI,
});
