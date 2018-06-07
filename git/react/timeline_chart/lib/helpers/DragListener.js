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

var _eventemitter = require('eventemitter3');

var _eventemitter2 = _interopRequireDefault(_eventemitter);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var DragListener = function (_EventEmitter) {
  (0, _inherits3.default)(DragListener, _EventEmitter);

  function DragListener(stopPropagation) {
    var grabCursor = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
    (0, _classCallCheck3.default)(this, DragListener);

    var _this = (0, _possibleConstructorReturn3.default)(this, (DragListener.__proto__ || (0, _getPrototypeOf2.default)(DragListener)).call(this));

    _this.start = { x: 0, y: 0 };
    _this.end = { x: 0, y: 0 };
    _this.delta = { x: 0, y: 0 };
    _this.isCapturing = false;
    _this.dragged = false;
    _this.handlers = {};
    _this.stopPropagation = false;
    _this.grabCursor = false;
    _this.onMouseOut = _this.onMouseUp;
    _this.onMouseLeave = _this.onMouseUp;


    _this.stopPropagation = stopPropagation;
    _this.grabCursor = grabCursor;

    _this.handlers = {
      onMouseUp: _this.onMouseUp.bind(_this),
      onMouseLeave: _this.onMouseLeave.bind(_this),
      onMouseMove: _this.onMouseMove.bind(_this),
      onMouseDown: _this.onMouseDown.bind(_this)
    };
    return _this;
  }

  (0, _createClass3.default)(DragListener, [{
    key: 'onMouseUp',
    value: function onMouseUp(e) {
      if (this.isCapturing) {
        this.isCapturing = false;
        this.dragged = false;

        if (this.grabCursor) {
          DragListener.setDefaultCursor(e.target);
        }

        this.emit('end', e);

        e.preventDefault();
      }
    }
  }, {
    key: 'onMouseMove',
    value: function onMouseMove(e) {
      if (this.isCapturing) {
        this.dragged = true;

        var delta = this.delta,
            end = this.end,
            start = this.start;


        end.x = e.nativeEvent.clientX;
        end.y = e.nativeEvent.clientY;

        delta.x = end.x - start.x;
        delta.y = end.y - start.y;

        this.emit('drag', start, end, delta, e);

        e.preventDefault();

        if (this.stopPropagation) {
          e.stopPropagation();
        }

        return true;
      }
    }
  }, {
    key: 'onMouseDown',
    value: function onMouseDown(e) {
      var start = this.start;


      start.x = e.nativeEvent.clientX;
      start.y = e.nativeEvent.clientY;

      if (this.grabCursor) {
        DragListener.setGrabCursor(e.target);
      }

      this.isCapturing = true;

      this.emit('start', start, e);
    }
  }], [{
    key: 'setDefaultCursor',
    value: function setDefaultCursor(element) {
      element.style.cursor = 'default';
    }
  }, {
    key: 'setGrabCursor',
    value: function setGrabCursor(element) {
      element.style.cursor = '-webkit-grabbing';
      element.style.cursor = '-moz-grabbing';
      element.style.cursor = 'grabbing';
    }
  }]);
  return DragListener;
}(_eventemitter2.default);

exports.default = DragListener;
