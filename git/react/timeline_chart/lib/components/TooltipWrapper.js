'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

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

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var TooltipWrapper = function (_React$Component) {
  (0, _inherits3.default)(TooltipWrapper, _React$Component);

  function TooltipWrapper() {
    var _ref;

    var _temp, _this, _ret;

    (0, _classCallCheck3.default)(this, TooltipWrapper);

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    return _ret = (_temp = (_this = (0, _possibleConstructorReturn3.default)(this, (_ref = TooltipWrapper.__proto__ || (0, _getPrototypeOf2.default)(TooltipWrapper)).call.apply(_ref, [this].concat(args))), _this), _this.state = { content: null, top: 0, left: 0, visible: false }, _this.ref = {}, _temp), (0, _possibleConstructorReturn3.default)(_this, _ret);
  }

  (0, _createClass3.default)(TooltipWrapper, [{
    key: 'setContent',
    value: function setContent(content) {
      this.setState({ content: content });
    }
  }, {
    key: 'setVisible',
    value: function setVisible(visible) {
      if (visible !== this.state.visible) {
        this.setState({ visible: visible });
      }
    }
  }, {
    key: 'setPosition',
    value: function setPosition(left, top) {
      this.setState({ top: top, left: left });
    }
  }, {
    key: '_updatePosition',
    value: function _updatePosition() {
      var root = this.ref.root;
      var _props = this.props,
          width = _props.width,
          height = _props.height;
      var _state = this.state,
          top = _state.top,
          left = _state.left;


      if (root != null) {
        if (left + root.offsetWidth > width) {
          left = width - root.offsetWidth - 15;
        }

        if (top + root.offsetHeight > height) {
          top = height - root.offsetHeight - 3;
        }

        root.style.transform = 'translate(' + left + 'px, ' + top + 'px)';
      }
    }
  }, {
    key: 'componentDidUpdate',
    value: function componentDidUpdate() {
      this._updatePosition();
    }
  }, {
    key: 'componentDidMount',
    value: function componentDidMount() {
      this._updatePosition();
    }
  }, {
    key: 'render',
    value: function render() {
      var _this2 = this;

      var _state2 = this.state,
          top = _state2.top,
          left = _state2.left,
          content = _state2.content,
          visible = _state2.visible;


      if (!visible) {
        return null;
      }

      return _react2.default.createElement(
        'div',
        { ref: function ref(_ref2) {
            return _this2.ref.root = _reactDom2.default.findDOMNode(_ref2);
          },
          style: { position: 'absolute', zIndex: 100, top: 0, left: 0, pointerEvents: 'none' } },
        content
      );
    }
  }]);
  return TooltipWrapper;
}(_react2.default.Component);

exports.default = TooltipWrapper;
