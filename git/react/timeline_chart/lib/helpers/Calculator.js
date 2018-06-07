'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _assign = require('babel-runtime/core-js/object/assign');

var _assign2 = _interopRequireDefault(_assign);

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

var _measureTextWidth = require('../helpers/measureTextWidth');

var _measureTextWidth2 = _interopRequireDefault(_measureTextWidth);

var _eventemitter = require('eventemitter3');

var _eventemitter2 = _interopRequireDefault(_eventemitter);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Calculator = function (_EventEmitter) {
  (0, _inherits3.default)(Calculator, _EventEmitter);

  function Calculator() {
    var _ref;

    (0, _classCallCheck3.default)(this, Calculator);

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    var _this = (0, _possibleConstructorReturn3.default)(this, (_ref = Calculator.__proto__ || (0, _getPrototypeOf2.default)(Calculator)).call.apply(_ref, [this].concat(args)));

    _this.props = {
      width: 0,
      paddingLeft: 0,
      start: 0,
      min: 0,
      max: 0,
      offsetMinRatio: 0,
      offsetMaxRatio: 0,
      offsetMin: 0,
      offsetMax: 0,
      timeToPixel: 0
    };
    _this._updateId = null;


    _this.__update = function () {
      _this._updateId = null;
      _this.emit('change');
    };
    return _this;
  }

  (0, _createClass3.default)(Calculator, [{
    key: 'forceUpdate',
    value: function forceUpdate() {
      if (this._updateId != null) {
        window.cancelAnimationFrame(this._updateId);
        this._updateId = null;
      }

      this._updateId = window.requestAnimationFrame(this.__update);
    }
  }, {
    key: 'update',
    value: function update(props) {
      var baseProps = this.props;

      (0, _assign2.default)(baseProps, props);

      var min = baseProps.min,
          max = baseProps.max,
          width = baseProps.width,
          offsetMinRatio = baseProps.offsetMinRatio,
          offsetMaxRatio = baseProps.offsetMaxRatio;

      var range = max - min;
      var offsetMin = min + offsetMinRatio * range;
      var offsetMax = max - offsetMaxRatio * range;

      baseProps.offsetMin = offsetMin;
      baseProps.offsetMax = offsetMax;
      baseProps.timeToPixel = width / (offsetMax - offsetMin);
      baseProps.offsetLeft = -(offsetMin - min) / (offsetMax - offsetMin) * width;

      this.forceUpdate();
    }
  }, {
    key: 'getPosition',
    value: function getPosition(time) {
      var _props = this.props,
          offsetMin = _props.offsetMin,
          timeToPixel = _props.timeToPixel,
          paddingLeft = _props.paddingLeft;


      return Math.round((time - offsetMin) * timeToPixel + paddingLeft);
    }
  }, {
    key: 'formatValue',
    value: function formatValue(value, precision) {
      return (value - this.props.start).toFixed(precision) + ' ms';
    }
  }, {
    key: 'getDividerOffsets',
    value: function getDividerOffsets() {
      var freeZoneAtLeft = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      var _props2 = this.props,
          paddingLeft = _props2.paddingLeft,
          start = _props2.start,
          offsetMax = _props2.offsetMax,
          offsetMin = _props2.offsetMin;

      var offsetRange = offsetMax - offsetMin;

      var clientWidth = this.getPosition(offsetMax);
      var pixelsPerTime = clientWidth / offsetRange;

      var dividersCount = clientWidth / Calculator.MinGridSlicePx;
      var gridSliceTime = offsetRange / dividersCount;

      // Align gridSliceTime to a nearest round value.
      // We allow spans that fit into the formula: span = (1|2|5)x10^n,
      // e.g.: ...  .1  .2  .5  1  2  5  10  20  50  ...
      // After a span has been chosen make grid lines at multiples of the span.

      var logGridSliceTime = Math.ceil(Math.log(gridSliceTime) / Math.LN10);
      gridSliceTime = Math.pow(10, logGridSliceTime);

      if (gridSliceTime * pixelsPerTime >= 5 * Calculator.MinGridSlicePx) {
        gridSliceTime = gridSliceTime / 5;
      }

      if (gridSliceTime * pixelsPerTime >= 2 * Calculator.MinGridSlicePx) {
        gridSliceTime = gridSliceTime / 2;
      }

      var leftBoundaryTime = offsetMin - paddingLeft / pixelsPerTime;
      var firstDividerTime = Math.ceil((leftBoundaryTime - start) / gridSliceTime) * gridSliceTime + start;
      var lastDividerTime = offsetMax;

      // Add some extra space past the right boundary as the rightmost divider label text
      // may be partially shown rather than just pop up when a new rightmost divider gets into the view.
      lastDividerTime += Calculator.MinGridSlicePx / pixelsPerTime;
      dividersCount = Math.ceil((lastDividerTime - firstDividerTime) / gridSliceTime);

      if (!gridSliceTime) {
        dividersCount = 0;
      }

      var offsets = [];
      for (var i = 0; i < dividersCount; ++i) {
        var time = firstDividerTime + gridSliceTime * i;
        if (this.getPosition(time) < freeZoneAtLeft) {
          continue;
        }

        offsets.push(time);
      }

      return { offsets: offsets, precision: Math.max(0, -Math.floor(Math.log(gridSliceTime * 1.01) / Math.LN10)) };
    }
  }, {
    key: 'drawGrid',
    value: function drawGrid(context, styles, height, paddingTop, headerHeight, freeZoneAtLeft) {
      context.save();

      var width = this.props.width;

      var dividersData = this.getDividerOffsets();
      var dividerOffsets = dividersData.offsets;
      var precision = dividersData.precision;

      if (headerHeight) {
        context.fillStyle = styles.headerBackgroundFillStyle;
        context.fillRect(0, 0, width, headerHeight);
      }

      context.fillStyle = styles.headerTextFillStyle;
      context.strokeStyle = styles.gridStrokeStyle;
      context.textBaseline = 'hanging';
      context.font = styles.font;
      context.lineWidth = styles.gridLineWidth;

      context.translate(0.5, 0.5);

      var paddingRight = 4;

      for (var i = 0; i < dividerOffsets.length; ++i) {
        var time = dividerOffsets[i];
        var position = this.getPosition(time);
        context.moveTo(position, 0);
        context.lineTo(position, height);

        if (!headerHeight) {
          continue;
        }

        var text = this.formatValue(time, precision);
        var textWidth = (0, _measureTextWidth2.default)(context, text);
        var textPosition = position - textWidth - paddingRight;
        if (!freeZoneAtLeft || freeZoneAtLeft < textPosition) {
          context.fillText(text, textPosition, paddingTop);
        }
      }

      context.stroke();
      context.restore();
      context.beginPath();
    }
  }]);
  return Calculator;
}(_eventemitter2.default);

Calculator.MinGridSlicePx = 64;
exports.default = Calculator;
