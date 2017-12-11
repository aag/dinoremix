import m from 'mithril';

import Comic from '../models/Comic';
import Permalink from './Permalink';

const ComicUI = {
  view: () => {
    return m('.comic', [
      m(Permalink),
    ]);
  }
}

export default ComicUI;
