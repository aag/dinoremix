import m from 'mithril';

import Permalink from './Permalink';

const ComicUI = {
  view: () =>
    m('.comic', [
      m(Permalink),
    ]),
};

export default ComicUI;
