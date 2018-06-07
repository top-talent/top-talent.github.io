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

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Canvas = function (_React$Component) {
  (0, _inherits3.default)(Canvas, _React$Component);

  function Canvas() {
    var _ref;

    var _temp, _this, _ret;

    (0, _classCallCheck3.default)(this, Canvas);

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    return _ret = (_temp = (_this = (0, _possibleConstructorReturn3.default)(this, (_ref = Canvas.__proto__ || (0, _getPrototypeOf2.default)(Canvas)).call.apply(_ref, [this].concat(args))), _this), _this.canvas = null, _this.context = null, _this.optimalDPI = Canvas.DPI, _this.totalFrameTime = 0, _this.frameCount = 0, _this.lastDPI = null, _temp), (0, _possibleConstructorReturn3.default)(_this, _ret);
  }

  (0, _createClass3.default)(Canvas, [{
    key: 'componentWillReceiveProps',
    value: function componentWillReceiveProps(nextProps) {
      if (this.props.autoScale && !nextProps.autoScale) {
        Canvas.canvasCount--;
      } else if (!this.props.autoScale && nextProps.autoScale) {
        Canvas.canvasCount++;
      }
    }
  }, {
    key: 'componentWillMount',
    value: function componentWillMount() {
      if (this.props.autoScale) {
        Canvas.canvasCount++;
      }
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      if (this.props.autoScale) {
        Canvas.canvasCount--;
      }
    }
  }, {
    key: 'frameStart',
    value: function frameStart() {
      this.startTime = Date.now();

      var currDPI = this.optimalDPI;

      if (this.lastDPI !== currDPI) {
        var context = this.context,
            canvas = this.canvas;
        var _props = this.props,
            height = _props.height,
            width = _props.width;


        Canvas.setDPI(canvas, context, width, height, currDPI);

        this.lastDPI = currDPI;
      }

      if (process.env.NODE_ENV !== 'production') {
        var _height = this.props.height;
        var _context = this.context,
            frameCount = this.frameCount,
            totalFrameTime = this.totalFrameTime;

        var avgFrameTime = totalFrameTime / frameCount;
        var canvasCount = Canvas.canvasCount;
        var fps = 1000 / avgFrameTime / canvasCount;

        _context.fillStyle = 'red';
        _context.fillText('DPI: ' + currDPI + '; FRAME: ' + frameCount + '; FPS: ' + fps.toFixed(2), 5, _height - 5);
      }
    }
  }, {
    key: 'frameEnd',
    value: function frameEnd() {
      var frameTime = Date.now() - this.startTime;
      var currDPI = this.optimalDPI;
      var totalFrameTime = this.totalFrameTime + frameTime;
      var frameCount = this.frameCount + 1;
      var avgFrameTime = totalFrameTime / frameCount;
      var canvasCount = Canvas.canvasCount;
      var nextDPI = this.optimalDPI;

      if (frameCount > Canvas.FRAME_GROUP_SIZE) {
        totalFrameTime = 0;
        frameCount = 0;
      } else if (avgFrameTime > Canvas.PREFERRED_FRAME_TIME / canvasCount && currDPI - Canvas.DPI_DSC >= Canvas.MIN_DPI) {
        nextDPI = currDPI - Canvas.DPI_DSC;
      } else if (avgFrameTime < Canvas.PREFERRED_FRAME_TIME / canvasCount && currDPI + Canvas.DPI_INC <= Canvas.MAX_DPI) {
        nextDPI = currDPI + Canvas.DPI_INC;
      }

      this.totalFrameTime = totalFrameTime;
      this.frameCount = frameCount;
      this.startTime = null;
      this.optimalDPI = nextDPI;
    }
  }, {
    key: '_createContext',
    value: function _createContext(ref) {
      if (ref == null) {
        return;
      }

      var _props2 = this.props,
          width = _props2.width,
          height = _props2.height;

      var canvas = _reactDom2.default.findDOMNode(ref);
      var context = canvas.getContext('2d');

      Canvas.setDPI(canvas, context, width, height, this.optimalDPI);
      this.lastDPI = this.optimalDPI;

      context.startTime = null;

      this.canvas = canvas;
      this.context = context;
    }
  }, {
    key: 'render',
    value: function render() {
      var _this2 = this;

      var _props3 = this.props,
          autoScale = _props3.autoScale,
          props = (0, _objectWithoutProperties3.default)(_props3, ['autoScale']);


      return _react2.default.createElement('canvas', (0, _extends3.default)({ ref: function ref(_ref2) {
          return _this2._createContext(_ref2);
        }
      }, props));
    }
  }], [{
    key: 'setDPI',
    value: function setDPI(canvas, context, width, height, dpi) {
      dpi = Math.round(dpi / 10) / 100;

      canvas.style.height = height + 'px';
      canvas.style.width = width + 'px';

      var scaledHeight = height * dpi;
      var scaledWidth = width * dpi;

      if (scaledHeight !== canvas.height) {
        canvas.height = scaledHeight;
        context.height = scaledHeight;
      }

      if (scaledWidth !== canvas.width) {
        canvas.width = scaledWidth;
        context.width = scaledWidth;
      }

      context.setTransform(1, 0, 0, 1, 0, 0);
      context.scale(dpi, dpi);
    }
  }]);
  return Canvas;
}(_react2.default.Component);

Canvas.DPI = (window.devicePixelRatio || 1) * 1000;
Canvas.DPI_INC = 50;
Canvas.DPI_DSC = 100;
Canvas.PREFERRED_FRAME_TIME = 1000 / 60;
Canvas.MIN_DPI = window.devicePixelRatio * 0.75 * 1000 + Canvas.DPI_DSC;
Canvas.MAX_DPI = (window.devicePixelRatio || 1) * 1000;
Canvas.FRAME_GROUP_SIZE = 60;
Canvas.canvasCount = 0;
Canvas.defaultProps = {
  autoScale: false
};
exports.default = Canvas;
