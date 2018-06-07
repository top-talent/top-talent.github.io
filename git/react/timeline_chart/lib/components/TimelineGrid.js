'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _classCallCheck2 = require('babel-runtime/helpers/classCallCheck');

var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);

var _createClass2 = require('babel-runtime/helpers/createClass');

var _createClass3 = _interopRequireDefault(_createClass2);

var _possibleConstructorReturn2 = require('babel-runtime/helpers/possibleConstructorReturn');

var _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);

var _inherits2 = require('babel-runtime/helpers/inherits');

var _inherits3 = _interopRequireDefault(_inherits2);

var _each2 = require('lodash/each');

var _each3 = _interopRequireDefault(_each2);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _radium = require('radium');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var TimelineGrid = function (_React$Component) {
  (0, _inherits3.default)(TimelineGrid, _React$Component);

  function TimelineGrid() {
    (0, _classCallCheck3.default)(this, TimelineGrid);
    return (0, _possibleConstructorReturn3.default)(this, (TimelineGrid.__proto__ || Object.getPrototypeOf(TimelineGrid)).apply(this, arguments));
  }

  (0, _createClass3.default)(TimelineGrid, [{
    key: 'render',
    value: function render() {
      var styles = this.props.styles;
      var _props = this.props,
          freeZoneAtLeft = _props.freeZoneAtLeft,
          width = _props.width,
          height = _props.height,
          children = _props.children,
          calculator = _props.calculator;

      var _calculator$getDivide = calculator.getDividerOffsets(freeZoneAtLeft),
          offsets = _calculator$getDivide.offsets,
          precision = _calculator$getDivide.precision;

      var dividers = [];
      var labels = [];

      (0, _each3.default)(offsets, function (offset, i) {
        var position = calculator.getPosition(offset);

        dividers.push(_react2.default.createElement('div', { className: 'resourcesDivider',
          key: i,
          style: { left: 100 * position / width + '%' } }));

        labels.push(_react2.default.createElement(
          'div',
          { className: 'resourcesDivider',
            key: i,
            style: { left: 100 * position / width + '%' } },
          _react2.default.createElement(
            'div',
            { className: 'resourcesDividerLabel' },
            calculator.formatValue(offset, precision)
          )
        ));
      });

      return _react2.default.createElement(
        'div',
        null,
        _react2.default.createElement(_radium.Style, { scopeSelector: '.timelineGrid',
          rules: styles.timelineGrid }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.resourcesDividers',
          rules: styles.resourcesDividers }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.resourcesDivider',
          rules: styles.resourcesDivider }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.timelineGridHeader',
          rules: styles.timelineGridHeader }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.resourcesDividerLabel',
          rules: styles.resourcesDividerLabel }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.resourcesDividersLabelBar',
          rules: styles.resourcesDividersLabelBar }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.resourcesEventDividers',
          rules: styles.resourcesEventDividers }),
        _react2.default.createElement(
          'div',
          { className: 'timelineGrid',
            style: { width: width, height: height } },
          _react2.default.createElement(
            'div',
            { className: 'resourcesDividers' },
            dividers
          ),
          _react2.default.createElement(
            'div',
            { className: 'timelineGridHeader' },
            _react2.default.createElement(
              'div',
              { className: 'resourcesDividersLabelBar' },
              labels
            ),
            _react2.default.createElement('div', { className: 'resourcesEventDividers' })
          ),
          _react2.default.createElement(
            'div',
            null,
            children
          )
        )
      );
    }
  }]);
  return TimelineGrid;
}(_react2.default.Component);

exports.default = TimelineGrid;
