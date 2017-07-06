module.exports = {
  module: {
    rules: [
      { test: /.jade$/, loader: 'jade' },
      { test: /.pug$/, loader: 'pug' },
    ],
  },
};
