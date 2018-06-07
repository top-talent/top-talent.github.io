'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = Tooltip;

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _radium = require('radium');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function Tooltip(_ref) {
  var entry = _ref.entry,
      styles = _ref.styles;

  return _react2.default.createElement(
    _radium.StyleRoot,
    null,
    _react2.default.createElement(_radium.Style, { scopeSelector: '.tooltip',
      rules: styles.tooltip }),
    _react2.default.createElement(
      'div',
      { className: 'tooltip' },
      _react2.default.createElement(
        'b',
        null,
        entry.end - entry.start,
        ' ms'
      ),
      ' ',
      entry.name
    )
  );
}
