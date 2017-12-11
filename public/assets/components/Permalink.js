import m from 'mithril';

import Comic from '../models/Comic';

const Permalink = {
    view: () => {
        return m('#permalinkHolder',
            m('a', {id: 'permaLink', href: Comic.getPermalink()}, [
                m('img', {src: '/images/link.png', alt: 'Link'}),
                ' ',
                m('span', {class: 'permaLinkText'}, 'Permalink to this remix')
            ])
        );
    },
};

export default Permalink;