const path = require('path');

module.exports = {
  resolve: {
    alias: {
      '~images': path.resolve(__dirname, './assets/src/images/')
    }
  }
};
