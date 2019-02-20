const m = require('mithril');

const Comic = require('../models/Comic');

const AltTextEditor = {
  isFormVisible: false,
  inputValue: '',

  handleCancelClick: () => {
    AltTextEditor.inputValue = Comic.altText;
    AltTextEditor.isFormVisible = false;
  },

  handleEditClick: () => {
    AltTextEditor.isFormVisible = true;
  },

  handleFormSubmit: (ev) => {
    ev.preventDefault();

    Comic.altText = AltTextEditor.inputValue;
    AltTextEditor.isFormVisible = false;
  },

  oncreate: () => {
    AltTextEditor.inputValue = Comic.altText;
  },

  view: () => {
    if (!AltTextEditor.isFormVisible) {
      return m('button.AltTextEditor', {
        class: 'Button Button--with-icon',
        onclick: AltTextEditor.handleEditClick,
      }, 'Edit alt text');
    }

    const input = m('input.AltTextEditor__input', {
      type: 'text',
      value: AltTextEditor.inputValue,
      oninput: m.withAttr('value', (val) => { AltTextEditor.inputValue = val; }),
    });

    const okButton = m('input.AltTextEditor__ok-button', {
      class: 'Button',
      type: 'submit',
      value: 'OK',
    });

    const cancelButton = m('button.AltTextEditor__cancel-button', {
      class: 'Button',
      onclick: AltTextEditor.handleCancelClick,
    }, 'Cancel');

    return m('.AltTextEditor',
      m('form', {
        onsubmit: AltTextEditor.handleFormSubmit,
      }, [input, okButton, cancelButton]));
  },
};

module.exports = AltTextEditor;
