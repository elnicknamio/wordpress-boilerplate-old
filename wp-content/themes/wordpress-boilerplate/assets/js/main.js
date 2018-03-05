function requireAll(r) { r.keys().forEach(r); }
requireAll(require.context('../img', true, /\.(jpe?g|png|gif|svg)$/));

require('../scss/style.scss')
