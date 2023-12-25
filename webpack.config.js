const path = require('path');
const { VueLoaderPlugin } = require('vue-loader');

module.exports = {
    mode: 'production',
    entry: ['./.eslintrc.js','./Resource/Js/app.js'],
    output: {
        path: path.resolve(__dirname, 'public/js'),
        filename: 'app.bundle.js',
    },
    module: {
        rules: [
          { test: /\.vue$/, loader: 'vue-loader' }
        ]
    },
    plugins: [
        new VueLoaderPlugin()
    ]
};