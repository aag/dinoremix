import reset from './reset.css';
import style from './dino.css';

import m from 'mithril';

import ComicUI from './components/ComicUI';

m.mount(document.querySelector('.comic'), ComicUI);
