global.window = require('mithril/test-utils/browserMock.js')();

global.document = window.document;

const o = require('mithril/ospec/ospec');
const mq = require('mithril-query');
const RandomPanels = require('../../models/RandomPanels');
const ReloadButton = require('../ReloadButton');
const Comic = require('../../models/Comic');

// Stub out the XHR request
RandomPanels.fetchFromServer = () => {};

o.spec('The ReloadButton component', () => {
  o.beforeEach(() => {
    window.location.search = '';
    Comic.lockedPanels = [];
  });

  o('renders correctly', () => {
    const output = mq(ReloadButton);
    output.should.have('.ReloadButton--unpressed');
    output.should.contain('Reload the unlocked panels');
  });

  o.spec('getNextPanelsUrl works', () => {
    o.beforeEach(() => {
      Comic.panels = {
        tl: '101',
        tm: '102',
        tr: '103',
        bl: '104',
        bm: '105',
        br: '106',
      };

      RandomPanels.panels = {
        tl: '201',
        tm: '202',
        tr: '203',
        bl: '204',
        bm: '205',
        br: '206',
      };
    });

    o('with all locked panels', () => {
      window.location.search = '?locked=tl-tm-tr-bl-bm-br';
      Comic.lockedPanels = ['tl', 'tm', 'tr', 'bl', 'bm', 'br'];
      o(ReloadButton.getNextPanelsUrl())
        .equals('?locked=tl-tm-tr-bl-bm-br&tl=101&tm=102&tr=103&bl=104&bm=105&br=106');
    });

    o('with no locked panels', () => {
      o(ReloadButton.getNextPanelsUrl())
        .equals('?tl=201&tm=202&tr=203&bl=204&bm=205&br=206');
    });

    o('with some locked panels', () => {
      window.location.search = '?locked=tm-bl-br';
      Comic.lockedPanels = ['tm', 'bl', 'br'];
      o(ReloadButton.getNextPanelsUrl())
        .equals('?locked=tm-bl-br&tl=201&tm=102&tr=203&bl=104&bm=205&br=106');
    });

    o('with missing nextPanel entries', () => {
      RandomPanels.panels = {};
      o(ReloadButton.getNextPanelsUrl())
        .equals('?tl=101&tm=102&tr=103&bl=104&bm=105&br=106');
    });
  });
});
