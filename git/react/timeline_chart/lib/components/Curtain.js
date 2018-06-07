'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = require('babel-runtime/helpers/extends');

var _extends3 = _interopRequireDefault(_extends2);

var _objectWithoutProperties2 = require('babel-runtime/helpers/objectWithoutProperties');

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _getPrototypeOf = require('babel-runtime/core-js/object/get-prototype-of');

var _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);

var _classCallCheck2 = require('babel-runtime/helpers/classCallCheck');

var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);

var _createClass2 = require('babel-runtime/helpers/createClass');

var _createClass3 = _interopRequireDefault(_createClass2);

var _possibleConstructorReturn2 = require('babel-runtime/helpers/possibleConstructorReturn');

var _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);

var _inherits2 = require('babel-runtime/helpers/inherits');

var _inherits3 = _interopRequireDefault(_inherits2);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _DragListener = require('../helpers/DragListener');

var _DragListener2 = _interopRequireDefault(_DragListener);

var _radium = require('radium');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Curtain = function (_React$Component) {
  (0, _inherits3.default)(Curtain, _React$Component);

  function Curtain() {
    var _ref;

    (0, _classCallCheck3.default)(this, Curtain);

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    var _this = (0, _possibleConstructorReturn3.default)(this, (_ref = Curtain.__proto__ || (0, _getPrototypeOf2.default)(Curtain)).call.apply(_ref, [this].concat(args)));

    _this.state = {};
    _this.dragListener = new _DragListener2.default();
    _this.dragListenerThumb = new _DragListener2.default(true, false);
    _this.ref = {};
    _this._offsetMinRatio = null;
    _this._offsetMaxRatio = null;
    _this._curtainName = null;


    _this.__render = _this._render.bind(_this);
    _this.__handleDragStart = _this._handleDragStart.bind(_this);
    _this.__handleDrag = _this._handleDrag.bind(_this);
    _this.__handleDragThumb = _this._handleDragThumb.bind(_this);
    _this.__handleDragEndThumb = _this._handleDragEndThumb.bind(_this);
    return _this;
  }

  (0, _createClass3.default)(Curtain, [{
    key: '_handleDragEndThumb',
    value: function _handleDragEndThumb() {
      var curtain = this.ref.curtain;


      _DragListener2.default.setDefaultCursor(curtain);
    }
  }, {
    key: '_handleDragStart',
    value: function _handleDragStart(start, e) {
      var calculator = this.props.calculator;
      var _calculator$props = calculator.props,
          offsetMinRatio = _calculator$props.offsetMinRatio,
          offsetMaxRatio = _calculator$props.offsetMaxRatio;
      var curtain = this.ref.curtain;


      _DragListener2.default.setGrabCursor(curtain);

      this._offsetMinRatio = offsetMinRatio;
      this._offsetMaxRatio = offsetMaxRatio;
      this._curtainName = e.target.getAttribute('data-name');
    }
  }, {
    key: '_handleDragThumb',
    value: function _handleDragThumb(start, end, delta) {
      var _props = this.props,
          width = _props.width,
          calculator = _props.calculator;
      var offsetMinRatio = this._offsetMinRatio,
          offsetMaxRatio = this._offsetMaxRatio;
      var _calculator$props2 = calculator.props,
          min = _calculator$props2.min,
          max = _calculator$props2.max;

      var range = max - min;

      var offset = delta.x / width;

      if (this._curtainName === 'L') {
        var nextOffsetMinRatio = Math.min(Math.max(offsetMinRatio + offset, 0), 1 - offsetMaxRatio);

        if ((max - offsetMaxRatio * range - (min + nextOffsetMinRatio * range)) / width <= 0.0005) {
          return;
        }

        calculator.update({
          offsetMinRatio: nextOffsetMinRatio
        });
      } else if (this._curtainName === 'R') {
        var nextOffsetMaxRatio = Math.min(Math.max(offsetMaxRatio - offset, 0), 1 - offsetMinRatio);

        if ((max - nextOffsetMaxRatio * range - (min + offsetMinRatio * range)) / width <= 0.0005) {
          return;
        }

        calculator.update({
          offsetMaxRatio: nextOffsetMaxRatio
        });
      }
    }
  }, {
    key: '_handleDrag',
    value: function _handleDrag(start, end, delta) {
      var _props2 = this.props,
          width = _props2.width,
          calculator = _props2.calculator;
      var offsetMinRatio = this._offsetMinRatio,
          offsetMaxRatio = this._offsetMaxRatio;


      var offset = delta.x / width;

      calculator.update({
        offsetMinRatio: Math.max(offsetMinRatio + offset, 0),
        offsetMaxRatio: Math.max(offsetMaxRatio - offset, 0)
      });
    }
  }, {
    key: '_render',
    value: function _render() {
      var _props$calculator$pro = this.props.calculator.props,
          offsetMinRatio = _props$calculator$pro.offsetMinRatio,
          offsetMaxRatio = _props$calculator$pro.offsetMaxRatio;
      var _ref2 = this.ref,
          leftCurtain = _ref2.leftCurtain,
          rightCurtain = _ref2.rightCurtain;


      leftCurtain.style.width = offsetMinRatio * 100 + '%';
      rightCurtain.style.width = offsetMaxRatio * 100 + '%';
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      var calculator = this.props.calculator;
      var dragListener = this.dragListener,
          dragListenerThumb = this.dragListenerThumb;


      calculator.removeListener('change', this.__render);

      dragListener.removeListener('drag', this.__handleDrag);
      dragListener.removeListener('start', this.__handleDragStart);
      dragListenerThumb.removeListener('drag', this.__handleDragThumb);
      dragListenerThumb.removeListener('start', this.__handleDragStart);
      dragListenerThumb.removeListener('end', this.__handleDragEndThumb);
    }
  }, {
    key: 'componentWillMount',
    value: function componentWillMount() {
      var calculator = this.props.calculator;
      var dragListener = this.dragListener,
          dragListenerThumb = this.dragListenerThumb;


      calculator.on('change', this.__render);

      dragListener.on('drag', this.__handleDrag);
      dragListener.on('start', this.__handleDragStart);
      dragListenerThumb.on('drag', this.__handleDragThumb);
      dragListenerThumb.on('start', this.__handleDragStart);
      dragListenerThumb.on('end', this.__handleDragEndThumb);
    }
  }, {
    key: 'render',
    value: function render() {
      var _this2 = this;

      var _props3 = this.props,
          width = _props3.width,
          height = _props3.height,
          styles = _props3.styles,
          calculator = _props3.calculator,
          props = (0, _objectWithoutProperties3.default)(_props3, ['width', 'height', 'styles', 'calculator']);
      var offsetMinRatio = calculator.offsetMinRatio,
          offsetMaxRatio = calculator.offsetMaxRatio;
      var dragListener = this.dragListener,
          dragListenerThumb = this.dragListenerThumb;


      return _react2.default.createElement(
        'div',
        dragListener.handlers,
        _react2.default.createElement(_radium.Style, { scopeSelector: '.curtains',
          rules: styles.curtains }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.curtainLeft',
          rules: styles.curtainLeft }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.curtainRight',
          rules: styles.curtainRight }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.curtainLeftThumb',
          rules: styles.curtainLeftThumb }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.curtainRightThumb',
          rules: styles.curtainRightThumb }),
        _react2.default.createElement(
          'div',
          (0, _extends3.default)({ className: 'curtains',
            style: { width: width, height: height },
            ref: function ref(_ref5) {
              return _this2.ref.curtain = _reactDom2.default.findDOMNode(_ref5);
            }
          }, props, {
            onMouseLeave: dragListenerThumb.handlers.onMouseLeave,
            onMouseMove: dragListenerThumb.handlers.onMouseMove,
            onMouseUp: dragListenerThumb.handlers.onMouseUp }),
          _react2.default.createElement(
            'div',
            { className: 'curtainLeft',
              ref: function ref(_ref3) {
                return _this2.ref.leftCurtain = _reactDom2.default.findDOMNode(_ref3);
              },
              style: { width: offsetMinRatio * 100 + '%' } },
            _react2.default.createElement('div', { className: 'curtainLeftThumb',
              'data-name': 'L',
              onMouseDown: dragListenerThumb.handlers.onMouseDown })
          ),
          _react2.default.createElement(
            'div',
            { className: 'curtainRight',
              ref: function ref(_ref4) {
                return _this2.ref.rightCurtain = _reactDom2.default.findDOMNode(_ref4);
              },
              style: { width: offsetMaxRatio * 100 + '%' } },
            _react2.default.createElement('div', { className: 'curtainRightThumb',
              'data-name': 'R',
              onMouseDown: dragListenerThumb.handlers.onMouseDown })
          )
        )
      );
    }
  }]);
  return Curtain;
}(_react2.default.Component);

exports.default = Curtain;
