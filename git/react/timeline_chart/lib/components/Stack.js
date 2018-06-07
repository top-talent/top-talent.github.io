'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.Tooltip = undefined;

var _extends2 = require('babel-runtime/helpers/extends');

var _extends3 = _interopRequireDefault(_extends2);

var _getIterator2 = require('babel-runtime/core-js/get-iterator');

var _getIterator3 = _interopRequireDefault(_getIterator2);

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

var _trim = require('../helpers/trim');

var _measureTextWidth = require('../helpers/measureTextWidth');

var _measureTextWidth2 = _interopRequireDefault(_measureTextWidth);

var _Canvas = require('./Canvas');

var _Canvas2 = _interopRequireDefault(_Canvas);

var _TooltipWrapper = require('./TooltipWrapper');

var _TooltipWrapper2 = _interopRequireDefault(_TooltipWrapper);

var _Tooltip = require('./Tooltip');

var _Tooltip2 = _interopRequireDefault(_Tooltip);

var _DragListener = require('../helpers/DragListener');

var _DragListener2 = _interopRequireDefault(_DragListener);

var _radium = require('radium');

var _Entry = require('../helpers/Entry');

var _Entry2 = _interopRequireDefault(_Entry);

var _setEntryDepth = require('../helpers/setEntryDepth');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var PropTypes = _react2.default.PropTypes;
exports.Tooltip = _Tooltip2.default;

var Stack = function (_React$Component) {
  (0, _inherits3.default)(Stack, _React$Component);

  function Stack() {
    var _ref;

    (0, _classCallCheck3.default)(this, Stack);

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    var _this = (0, _possibleConstructorReturn3.default)(this, (_ref = Stack.__proto__ || (0, _getPrototypeOf2.default)(Stack)).call.apply(_ref, [this].concat(args)));

    _this._scrollTop = 0;
    _this._lastTooltipEntry = 0;
    _this._mouseDownTooltipTime = 0;
    _this.scrollTop = 0;
    _this.dragListener = new _DragListener2.default();
    _this.ref = {};
    _this.state = {
      maxDepth: 0,
      scrollTop: 0
    };


    _this.__renderChart = _this._renderChart.bind(_this);
    _this.__renderOverview = _this._renderOverview.bind(_this);
    _this.__handleDrag = _this._handleDrag.bind(_this);
    _this.__handleDragStart = _this._handleDragStart.bind(_this);
    return _this;
  }

  (0, _createClass3.default)(Stack, [{
    key: '_handleMouseLeave',
    value: function _handleMouseLeave(e) {
      var dragListener = this.dragListener;
      var tooltipWrapper = this.ref.tooltipWrapper;


      dragListener.onMouseLeave(e);

      tooltipWrapper.setVisible(false);
    }
  }, {
    key: '_handleMouseMove',
    value: function _handleMouseMove(e) {
      var dragListener = this.dragListener;
      var tooltipWrapper = this.ref.tooltipWrapper;


      if (!dragListener.onMouseMove(e)) {
        var x = e.nativeEvent.offsetX;
        var y = e.nativeEvent.offsetY;

        var entry = this.getEntryAt(x, y);

        if (entry != null) {
          var _props = this.props,
              tooltip = _props.tooltip,
              styles = _props.styles;


          if (entry !== this._lastTooltipEntry) {
            var tooltipContent = null;
            if (tooltip != null) {
              tooltipContent = _react2.default.cloneElement(tooltip, {
                entry: entry,
                styles: styles,
                timing: entry.timing
              });
            }

            this._lastTooltipEntry = entry;

            tooltipWrapper.setContent(tooltipContent);
          }

          tooltipWrapper.setVisible(true);
          tooltipWrapper.setPosition(x + 10, y + 10);
        } else {
          tooltipWrapper.setVisible(false);
        }
      } else {
        tooltipWrapper.setVisible(false);
      }
    }
  }, {
    key: '_handleScroll',
    value: function _handleScroll(e) {
      this.scrollTop = e.target.scrollTop;

      this._renderChart();

      e.stopPropagation();
    }
  }, {
    key: '_handleCollapse',
    value: function _handleCollapse(e) {
      var _props2 = this.props,
          setCollapsed = _props2.setCollapsed,
          computedCollapsed = _props2.computedCollapsed;


      setCollapsed(!computedCollapsed);

      e.stopPropagation();
    }
  }, {
    key: '_handleDragStart',
    value: function _handleDragStart() {
      this._scrollTop = this.scrollTop;
    }
  }, {
    key: '_handleDrag',
    value: function _handleDrag(start, end, delta) {
      var scroller = this.ref.scroller;
      var scrollHeight = scroller.scrollHeight,
          offsetHeight = scroller.offsetHeight;


      this._mouseDownTooltipTime = 0;

      scroller.scrollTop = Math.max(Math.min(this._scrollTop + -delta.y, scrollHeight - offsetHeight), 0);
    }
  }, {
    key: '_handleTooltipMouseDown',
    value: function _handleTooltipMouseDown() {
      this._mouseDownTooltipTime = Date.now();
    }
  }, {
    key: '_handleTooltipMouseUp',
    value: function _handleTooltipMouseUp(e) {
      if (Date.now() - this._mouseDownTooltipTime <= Stack.MOUSE_CLICK_TIMEOUT) {
        var onEntryClick = this.props.onEntryClick;


        if (onEntryClick != null) {
          var _e$nativeEvent = e.nativeEvent,
              x = _e$nativeEvent.offsetX,
              y = _e$nativeEvent.offsetY;


          var entry = this.getEntryAt(x, y);

          if (entry != null) {
            onEntryClick(entry.timing, entry, e);
          }
        }
      }
    }
  }, {
    key: 'getEntryAt',
    value: function getEntryAt(x, y) {
      var entries = this.state.entries;
      var _iteratorNormalCompletion = true;
      var _didIteratorError = false;
      var _iteratorError = undefined;

      try {

        for (var _iterator = (0, _getIterator3.default)(entries), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
          var entry = _step.value;
          var visible = entry.visible,
              rect = entry.rect;

          if (visible === false) {
            continue;
          }

          if (x >= rect.x && x <= rect.x + rect.width && y >= rect.y && y <= rect.y + rect.height) {
            return entry;
          }
        }
      } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion && _iterator.return) {
            _iterator.return();
          }
        } finally {
          if (_didIteratorError) {
            throw _iteratorError;
          }
        }
      }
    }
  }, {
    key: 'createEntries',
    value: function createEntries(props) {
      var entryStartGetter = props.entryStartGetter,
          entryEndGetter = props.entryEndGetter,
          entryNameGetter = props.entryNameGetter,
          entryFillGetter = props.entryFillGetter,
          entrySelectedGetter = props.entrySelectedGetter,
          entryHighlightedGetter = props.entryHighlightedGetter,
          entryTextFillGetter = props.entryTextFillGetter;
      var timings = props.timings;

      var length = timings.length;
      var entries = new Array(length);

      for (var i = 0; i < length; i++) {
        var timing = timings[i];
        var entry = new _Entry2.default(); // TODO cache these?
        var start = entryStartGetter(timing);
        var end = entryEndGetter(timing);
        var name = String(entryNameGetter(timing));
        var fill = entryFillGetter(timing, 'default');
        var overviewFill = entryFillGetter(timing, 'overview');

        entry.start = start;
        entry.end = end;
        entry.name = name;
        entry.textFill = entryTextFillGetter != null && entryTextFillGetter(timing, entry);
        entry.fill = fill;
        entry.overviewFill = overviewFill;
        entry.timing = timing;
        entry.selected = entrySelectedGetter != null && entrySelectedGetter(timing, entry);
        entry.highlighted = entryHighlightedGetter != null && entryHighlightedGetter(timing, entry);

        entries[i] = entry;
      }

      return (0, _setEntryDepth.greedyStrategy)(entries);
    }
  }, {
    key: '_computeEntryRects',
    value: function _computeEntryRects() {
      var entries = this.state.entries;
      var _props3 = this.props,
          width = _props3.computedWidth,
          calculator = _props3.calculator,
          height = _props3.computedHeight,
          styles = _props3.styles;


      var entryHeight = styles.stackEntry.height;
      var _calculator$props = calculator.props,
          min = _calculator$props.min,
          offsetMin = _calculator$props.offsetMin,
          offsetMax = _calculator$props.offsetMax,
          scrollLeft = _calculator$props.offsetLeft;

      var scrollTop = this.scrollTop;
      var offsetRange = offsetMax - offsetMin;

      var _iteratorNormalCompletion2 = true;
      var _didIteratorError2 = false;
      var _iteratorError2 = undefined;

      try {
        for (var _iterator2 = (0, _getIterator3.default)(entries), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
          var entry = _step2.value;
          var depth = entry.depth,
              rect = entry.rect,
              start = entry.start,
              end = entry.end;

          var x = (start - min) / offsetRange * width + scrollLeft;
          var y = depth * entryHeight + 18 - scrollTop;

          var entryWidth = Math.round((end - start) / offsetRange * width);
          var visibleWidth = x < 0 ? x + entryWidth : entryWidth;

          entry.visible = false;

          if (x + visibleWidth > width) {
            visibleWidth -= x + visibleWidth - width;
          }

          if (visibleWidth <= 0) {
            continue;
          }

          visibleWidth = Math.max(3, visibleWidth);

          if (x > width) {
            continue;
          }

          if (y > height) {
            continue;
          }

          entry.visible = true;

          rect.x = Math.max(x, 0) + 0.5;
          rect.y = y + 0.5;
          rect.height = entryHeight;
          rect.width = visibleWidth;
        }
      } catch (err) {
        _didIteratorError2 = true;
        _iteratorError2 = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion2 && _iterator2.return) {
            _iterator2.return();
          }
        } finally {
          if (_didIteratorError2) {
            throw _iteratorError2;
          }
        }
      }
    }
  }, {
    key: '_renderBackground',
    value: function _renderBackground() {
      var context = this.ref.chart.context;
      var _props4 = this.props,
          styles = _props4.styles,
          height = _props4.computedHeight;
      var entries = this.state.entries;


      context.beginPath();

      context.fillStyle = styles.stackEntrySelected.backdropFillStyle;

      var _iteratorNormalCompletion3 = true;
      var _didIteratorError3 = false;
      var _iteratorError3 = undefined;

      try {
        for (var _iterator3 = (0, _getIterator3.default)(entries), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
          var entry = _step3.value;
          var visible = entry.visible;

          if (visible) {
            var _entry$rect = entry.rect,
                x = _entry$rect.x,
                entryWidth = _entry$rect.width,
                highlighted = entry.highlighted,
                selected = entry.selected;

            if (selected) {
              context.fillRect(x, 0, entryWidth, height);
            } else if (highlighted) {
              context.rect(x, 0, entryWidth, height);
            }
          }
        }
      } catch (err) {
        _didIteratorError3 = true;
        _iteratorError3 = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion3 && _iterator3.return) {
            _iterator3.return();
          }
        } finally {
          if (_didIteratorError3) {
            throw _iteratorError3;
          }
        }
      }

      context.fillStyle = styles.stackEntryHighlighted.backdropFillStyle;

      context.fill();
      context.closePath();
    }
  }, {
    key: '_renderContent',
    value: function _renderContent() {
      var context = this.ref.chart.context;
      var styles = this.props.styles;
      var entries = this.state.entries;


      context.beginPath();

      context.textBaseline = 'alphabetic';
      context.font = styles.stackEntry.font;

      var minTextWidth = (0, _measureTextWidth2.default)(context, '-');

      var _iteratorNormalCompletion4 = true;
      var _didIteratorError4 = false;
      var _iteratorError4 = undefined;

      try {
        for (var _iterator4 = (0, _getIterator3.default)(entries), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
          var _ref3 = _step4.value;
          var _ref3$rect = _ref3.rect,
              x = _ref3$rect.x,
              y = _ref3$rect.y,
              entryWidth = _ref3$rect.width,
              entryHeight = _ref3$rect.height,
              visible = _ref3.visible,
              textFill = _ref3.textFill,
              fill = _ref3.fill,
              name = _ref3.name,
              highlighted = _ref3.highlighted,
              selected = _ref3.selected;

          if (visible) {
            if (selected) {
              context.fillStyle = styles.stackEntrySelected.fillStyle;
              context.fillRect(x, y, entryWidth - 1, entryHeight);
              context.fillStyle = styles.stackEntrySelected.textFillStyle;
            } else if (highlighted) {
              context.fillStyle = styles.stackEntryHighlighted.fillStyle;
              context.fillRect(x, y, entryWidth - 1, entryHeight);
              context.fillStyle = styles.stackEntryHighlighted.textFillStyle;
            } else {
              context.fillStyle = fill;
              context.fillRect(x, y, entryWidth - 1, entryHeight);
              context.rect(x, y, entryWidth, entryHeight);
              context.fillStyle = textFill || styles.stackEntry.textFillStyle;
            }

            if (entryWidth > minTextWidth) {
              var textStart = Math.max(x, 0);
              var textWidth = entryWidth;
              var textBaseHeight = entryHeight - styles.stackEntry.textBaseline;
              var trimmedText = (0, _trim.trimTextMiddle)(context, name, textWidth - 2 * styles.stackEntry.textPadding);

              if (trimmedText.length > 0) {
                context.fillText(trimmedText, textStart + styles.stackEntry.textPadding, y + textBaseHeight);
              }
            }
          }
        }
      } catch (err) {
        _didIteratorError4 = true;
        _iteratorError4 = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion4 && _iterator4.return) {
            _iterator4.return();
          }
        } finally {
          if (_didIteratorError4) {
            throw _iteratorError4;
          }
        }
      }

      context.strokeStyle = styles.stackEntry.strokeStyle;

      context.stroke();
      context.closePath();
    }
  }, {
    key: '_renderForeground',
    value: function _renderForeground() {
      var context = this.ref.chart.context;
      var styles = this.props.styles;
      var entries = this.state.entries;


      context.beginPath();

      context.strokeStyle = styles.stackEntrySelected.strokeStyle;

      var _iteratorNormalCompletion5 = true;
      var _didIteratorError5 = false;
      var _iteratorError5 = undefined;

      try {
        for (var _iterator5 = (0, _getIterator3.default)(entries), _step5; !(_iteratorNormalCompletion5 = (_step5 = _iterator5.next()).done); _iteratorNormalCompletion5 = true) {
          var entry = _step5.value;
          var visible = entry.visible;

          if (visible) {
            var _entry$rect2 = entry.rect,
                x = _entry$rect2.x,
                y = _entry$rect2.y,
                entryWidth = _entry$rect2.width,
                entryHeight = _entry$rect2.height,
                selected = entry.selected,
                highlighted = entry.highlighted;

            if (selected) {
              context.strokeRect(x + 0.5, y, entryWidth - 0.5, entryHeight);
            } else if (highlighted) {
              context.rect(x + 0.5, y, entryWidth - 0.5, entryHeight);
            }
          }
        }
      } catch (err) {
        _didIteratorError5 = true;
        _iteratorError5 = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion5 && _iterator5.return) {
            _iterator5.return();
          }
        } finally {
          if (_didIteratorError5) {
            throw _iteratorError5;
          }
        }
      }

      context.strokeStyle = styles.stackEntryHighlighted.strokeStyle;

      context.stroke();
      context.closePath();
    }
  }, {
    key: '_renderChart',
    value: function _renderChart() {
      var _ref4 = this.ref,
          chart = _ref4.chart,
          context = _ref4.chart.context;
      var _props5 = this.props,
          width = _props5.computedWidth,
          height = _props5.computedHeight,
          computedCollapsed = _props5.computedCollapsed;


      context.clearRect(0, 0, width, height);

      if (computedCollapsed) {
        return;
      }

      this._computeEntryRects();

      chart.frameStart();

      this._renderBackground();
      this._renderContent();
      this._renderForeground();

      chart.frameEnd();
    }
  }, {
    key: '_renderOverview',
    value: function _renderOverview() {
      var computedShowsOverview = this.props.computedShowsOverview;


      if (computedShowsOverview === false) {
        return;
      }

      var _state = this.state,
          entries = _state.entries,
          maxDepth = _state.maxDepth;
      var _props6 = this.props,
          width = _props6.computedWidth,
          overviewType = _props6.overviewType,
          height = _props6.overviewHeight,
          overviewCalculator = _props6.overviewCalculator,
          context = _props6.overviewCanvas.ref.context;
      var _overviewCalculator$p = overviewCalculator.props,
          min = _overviewCalculator$p.min,
          max = _overviewCalculator$p.max;

      var range = max - min;

      context.clearRect(0, 0, width, height);
      context.beginPath();

      var _iteratorNormalCompletion6 = true;
      var _didIteratorError6 = false;
      var _iteratorError6 = undefined;

      try {
        for (var _iterator6 = (0, _getIterator3.default)(entries), _step6; !(_iteratorNormalCompletion6 = (_step6 = _iterator6.next()).done); _iteratorNormalCompletion6 = true) {
          var _ref6 = _step6.value;
          var overviewFill = _ref6.overviewFill,
              timing = _ref6.timing,
              depth = _ref6.depth;

          var x = (timing.start - min) / range * width;
          var entryWidth = (timing.end - timing.start) / range * width;

          context.fillStyle = overviewFill;

          if (overviewType === 'spread') {
            context.fillRect(x, 0, entryWidth, depth / maxDepth * height);
          } else {
            context.fillRect(x, Math.floor(depth / maxDepth * height), entryWidth, Math.ceil(1 / maxDepth * height));
          }
        }
      } catch (err) {
        _didIteratorError6 = true;
        _iteratorError6 = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion6 && _iterator6.return) {
            _iterator6.return();
          }
        } finally {
          if (_didIteratorError6) {
            throw _iteratorError6;
          }
        }
      }

      context.closePath();
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      var _props7 = this.props,
          calculator = _props7.calculator,
          overviewCalculator = _props7.overviewCalculator;
      var dragListener = this.dragListener;


      calculator.removeListener('change', this.__renderChart);
      overviewCalculator.removeListener('change', this.__renderOverview);

      dragListener.removeListener('start', this.__handleDragStart);
      dragListener.removeListener('drag', this.__handleDrag);
    }
  }, {
    key: 'componentWillMount',
    value: function componentWillMount() {
      var entryInfo = this.createEntries(this.props);
      var _props8 = this.props,
          calculator = _props8.calculator,
          overviewCalculator = _props8.overviewCalculator;
      var dragListener = this.dragListener;


      calculator.on('change', this.__renderChart);
      overviewCalculator.on('change', this.__renderOverview);

      dragListener.on('start', this.__handleDragStart);
      dragListener.on('drag', this.__handleDrag);

      this.setState(entryInfo);
    }
  }, {
    key: 'componentWillReceiveProps',
    value: function componentWillReceiveProps(nextProps) {
      var entryInfo = this.createEntries(nextProps);

      this.setState(entryInfo);
    }
  }, {
    key: 'rerender',
    value: function rerender() {
      this._renderChart();
    }
  }, {
    key: 'render',
    value: function render() {
      var _this2 = this;

      var dragListener = this.dragListener;
      var maxDepth = this.state.maxDepth;
      var _props9 = this.props,
          width = _props9.computedWidth,
          height = _props9.computedHeight,
          name = _props9.name,
          computedCollapsed = _props9.computedCollapsed,
          styles = _props9.styles,
          children = _props9.children;

      var entryHeight = styles.stackEntry.height;
      var contentHeight = computedCollapsed ? 0 : entryHeight * (maxDepth + 1) + 18 + 2;

      return _react2.default.createElement(
        'div',
        { style: { position: 'relative' },
          onMouseUp: this._handleTooltipMouseUp.bind(this),
          onMouseDown: this._handleTooltipMouseDown.bind(this) },
        _react2.default.createElement(_radium.Style, { scopeSelector: '.stackSearch',
          rules: styles.stackSearch }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.stackHeader',
          rules: styles.stackHeader }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.stackTitle',
          rules: styles.stackTitle }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.stackArrow',
          rules: styles.stackArrow }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.stackScroller',
          rules: styles.stackScroller }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.stackCanvas',
          rules: styles.stackCanvas }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.stackTitleGroup',
          rules: styles.stackTitleGroup }),
        _react2.default.createElement(_TooltipWrapper2.default, { ref: function ref(_ref7) {
            return _this2.ref.tooltipWrapper = _ref7;
          },
          width: width,
          height: height,
          styles: styles }),
        _react2.default.createElement(
          'div',
          (0, _extends3.default)({ style: { height: height, width: width, position: 'relative', userSelect: 'none' }
          }, dragListener.handlers, {
            onMouseLeave: this._handleMouseLeave.bind(this),
            onMouseMove: this._handleMouseMove.bind(this) }),
          _react2.default.createElement(_Canvas2.default, { ref: function ref(_ref8) {
              return _this2.ref.chart = _ref8;
            },
            className: 'stackCanvas',
            width: width,
            autoScale: true,
            height: height }),
          contentHeight > height && _react2.default.createElement(
            'div',
            { className: 'stackScroller',
              ref: function ref(_ref9) {
                return _this2.ref.scroller = _reactDom2.default.findDOMNode(_ref9);
              },
              onWheel: function onWheel(e) {
                return e.stopPropagation();
              },
              onScroll: this._handleScroll.bind(this) },
            _react2.default.createElement('div', { style: { width: width, height: contentHeight } })
          ),
          _react2.default.createElement(
            'div',
            { className: 'stackHeader' },
            _react2.default.createElement(
              'div',
              null,
              _react2.default.createElement(
                'div',
                { className: 'stackTitleGroup',
                  onClick: this._handleCollapse.bind(this) },
                _react2.default.createElement(
                  'div',
                  { className: 'stackArrow' },
                  computedCollapsed ? '▶' : '▼'
                ),
                _react2.default.createElement(
                  'div',
                  { className: 'stackTitle' },
                  name
                )
              )
            )
          )
        ),
        children
      );
    }
  }]);
  return Stack;
}(_react2.default.Component);

Stack.MOUSE_CLICK_TIMEOUT = 100;
Stack.propTypes = {
  name: PropTypes.string.isRequired,
  event: PropTypes.shape({ name: PropTypes.string }),
  styles: PropTypes.object,
  overviewType: PropTypes.oneOf(['default', 'spread']),
  tooltip: PropTypes.element,
  defaultHeight: PropTypes.oneOfType([PropTypes.number, PropTypes.string]).isRequired,
  height: PropTypes.oneOfType([PropTypes.number, PropTypes.string]),
  overviewHeight: PropTypes.number,
  collapsedHeight: PropTypes.number,
  defaultCollapsed: PropTypes.func,
  collapsed: PropTypes.bool,
  onEntryClick: PropTypes.func,
  entryHeight: PropTypes.number.isRequired,
  entryNameGetter: PropTypes.func.isRequired,
  entryStartGetter: PropTypes.func.isRequired,
  entryEndGetter: PropTypes.func.isRequired,
  entryFillGetter: PropTypes.func.isRequired,
  entryHighlightedGetter: PropTypes.func,
  entrySelectedGetter: PropTypes.func,
  entryTextFillGetter: PropTypes.func
};
Stack.defaultProps = {
  defaultType: 1,
  computedHeight: null,
  defaultHeight: 100,
  overviewHeight: 10,
  collapsedHeight: 19,
  entryHeight: 17,
  overviewType: 'default',
  tooltip: _react2.default.createElement(_Tooltip2.default, null)
};
exports.default = Stack;
