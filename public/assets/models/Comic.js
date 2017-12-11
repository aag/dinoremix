

const Comic = {
    unlockedPanels: [
        'tl', 'tm', 'tr', 'bl', 'bm', 'br'
    ],
    numPanels: 3,
    panels: {
        tl: 'comic2-100-topleft.png',
        tm: 'comic2-100-topmiddle.png',
        tr: 'comic2-100-topright.png',
        bl: 'comic2-100-bottomleft.png',
        bm: 'comic2-100-bottommiddle.png',
        br: 'comic2-100-bottomright.png',
    },

    getPermalink: () => {
        const panelsQueryString = Comic.getAllPanelsQueryString();
        return `?numPanels=${Comic.numPanels}${panelsQueryString}`
    },

    getAllPanelsQueryString: () => {
        return Object.entries(Comic.panels).reduce((queryString, panel) => {
            const comicNum = Comic.getCurrentComicForPanel(panel[0]);
            return `${queryString}&${panel[0]}=${comicNum}`;
        }, '');
    },

    getCurrentComicForPanel: (panel) => {
        const filename = Comic.panels[panel];
        const start = filename.indexOf('-') + 1;
        const end = filename.lastIndexOf('-');
        return filename.substr(start, end - start);
    },

    reloadUnlocked: () => {
        const posList = Comic.unlockedPanels.join('-');

        return m.request({
            method: "GET",
            url: `/images/random?pos=${posList}`,
        })
        .then(function(result) {
            User.list = result.data
            for (panel of result.data) {
                Comic.panels[panel.pos] = panel.file;
            }
        })
    }
};

export default Comic;
