'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.Stack = undefined;

var _defineProperty2 = require('babel-runtime/helpers/defineProperty');

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _getIterator2 = require('babel-runtime/core-js/get-iterator');

var _getIterator3 = _interopRequireDefault(_getIterator2);

var _extends4 = require('babel-runtime/helpers/extends');

var _extends5 = _interopRequireDefault(_extends4);

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

var _Canvas = require('./Canvas');

var _Canvas2 = _interopRequireDefault(_Canvas);

var _Stack = require('./Stack');

var _Stack2 = _interopRequireDefault(_Stack);

var _Curtain = require('./Curtain');

var _Curtain2 = _interopRequireDefault(_Curtain);

var _DragListener = require('../helpers/DragListener');

var _DragListener2 = _interopRequireDefault(_DragListener);

var _reactSplitPane = require('react-split-pane');

var _reactSplitPane2 = _interopRequireDefault(_reactSplitPane);

var _Themes = require('./Themes');

var _Themes2 = _interopRequireDefault(_Themes);

var _radium = require('radium');

var _Calculator = require('../helpers/Calculator');

var _Calculator2 = _interopRequireDefault(_Calculator);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var PropTypes = _react2.default.PropTypes;
exports.Stack = _Stack2.default;

var FlameChart = function (_React$Component) {
  (0, _inherits3.default)(FlameChart, _React$Component);

  function FlameChart() {
    var _ref;

    (0, _classCallCheck3.default)(this, FlameChart);

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    var _this = (0, _possibleConstructorReturn3.default)(this, (_ref = FlameChart.__proto__ || (0, _getPrototypeOf2.default)(FlameChart)).call.apply(_ref, [this].concat(args)));

    _this._offsetMinRatio = 0;
    _this._offsetMaxRatio = 0;
    _this.dragListener = new _DragListener2.default();
    _this.calculator = new _Calculator2.default();
    _this.overviewCalculator = new _Calculator2.default();
    _this.ref = {};
    _this.state = {
      stackHeights: {},
      stackCollapsed: {},
      scrollLeft: 0
    };


    _this.__renderStackGrid = _this._renderStackGrid.bind(_this);
    _this.__renderOverviewGrid = _this._renderOverviewGrid.bind(_this);
    _this.__handleDrag = _this._handleDrag.bind(_this);
    _this.__handleDragStart = _this._handleDragStart.bind(_this);
    return _this;
  }

  (0, _createClass3.default)(FlameChart, [{
    key: '_handleDragStart',
    value: function _handleDragStart() {
      var _calculator$props = this.calculator.props,
          offsetMinRatio = _calculator$props.offsetMinRatio,
          offsetMaxRatio = _calculator$props.offsetMaxRatio;


      this._offsetMinRatio = offsetMinRatio;
      this._offsetMaxRatio = offsetMaxRatio;
    }
  }, {
    key: '_handleDrag',
    value: function _handleDrag(start, end, delta) {
      var calculator = this.calculator;
      var width = this.props.width;
      var offsetMinRatio = this._offsetMinRatio,
          offsetMaxRatio = this._offsetMaxRatio;


      var rate = Math.pow(1 - (offsetMinRatio + offsetMaxRatio), 1.1);

      var cropOffsetX = delta.x / width * rate;

      if (offsetMinRatio - cropOffsetX < 0) {
        cropOffsetX = offsetMinRatio;
      }

      if (offsetMaxRatio + cropOffsetX < 0) {
        cropOffsetX += Math.abs(offsetMaxRatio + cropOffsetX);
      }

      calculator.update({
        offsetMinRatio: offsetMinRatio - cropOffsetX,
        offsetMaxRatio: offsetMaxRatio + cropOffsetX
      });
    }
  }, {
    key: '_handleWheel',
    value: function _handleWheel(e) {
      e.preventDefault();

      if (e.deltaY === 0) {
        return;
      }

      var _props = this.props,
          width = _props.width,
          min = _props.min,
          max = _props.max;
      var calculator = this.calculator,
          _calculator$props2 = this.calculator.props,
          offsetMinRatio = _calculator$props2.offsetMinRatio,
          offsetMaxRatio = _calculator$props2.offsetMaxRatio;


      var ratio = e.nativeEvent.offsetX / width;
      var rate = Math.pow(1 - (offsetMinRatio + offsetMaxRatio), 1.1);

      var nextOffsetMinRatio = Math.max(0, offsetMinRatio + e.deltaY / width * ratio * rate);
      var nextOffsetMaxRatio = Math.max(0, offsetMaxRatio + e.deltaY / width * (1 - ratio) * rate);
      var range = max - min;

      if ((max - nextOffsetMaxRatio * range - (min + nextOffsetMinRatio * range)) / width <= 0.0005) {
        return;
      }

      calculator.update({
        offsetMinRatio: nextOffsetMinRatio,
        offsetMaxRatio: nextOffsetMaxRatio
      });
    }
  }, {
    key: '_getHeights',
    value: function _getHeights(stackHeights, stackCollapsed) {
      var props = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : this.props;

      stackHeights = (0, _extends5.default)({}, stackHeights);
      stackCollapsed = (0, _extends5.default)({}, stackCollapsed);

      var children = props.children;
      var height = props.height,
          stackTimelineHeaderHeight = props.stackTimelineHeaderHeight,
          overviewTimelineHeaderHeight = props.overviewTimelineHeaderHeight,
          onStackHeightChange = props.onStackHeightChange,
          onStackCollapse = props.onStackCollapse;
      var _state$stackCollapsed = this.state.stackCollapsed,
          lastStackCollapsed = _state$stackCollapsed === undefined ? {} : _state$stackCollapsed;


      var overviewViewportHeight = 0;

      children = _react2.default.Children.toArray(children);

      nextName: for (var k in stackCollapsed) {
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
          for (var _iterator = (0, _getIterator3.default)(children), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
            var _ref3 = _step.value;
            var name = _ref3.props.name;

            if (k === name) {
              continue nextName;
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

        delete stackCollapsed[k];
      }

      var _iteratorNormalCompletion2 = true;
      var _didIteratorError2 = false;
      var _iteratorError2 = undefined;

      try {
        for (var _iterator2 = (0, _getIterator3.default)(children), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
          var _ref11 = _step2.value;
          var _ref11$props = _ref11.props,
              _name4 = _ref11$props.name,
              defaultHeight = _ref11$props.defaultHeight,
              _height = _ref11$props.height,
              overviewHeight = _ref11$props.overviewHeight,
              defaultCollapsed = _ref11$props.defaultCollapsed,
              collapsed = _ref11$props.collapsed;

          var isControlledCollapse = collapsed != null && onStackCollapse != null;

          if (!isControlledCollapse) {
            if (!stackCollapsed.hasOwnProperty(_name4)) {
              stackCollapsed[_name4] = defaultCollapsed || false;
            }
          } else {
            stackCollapsed[_name4] = collapsed;
          }

          var isControlledHeight = _height != null && onStackHeightChange != null;

          if (!isControlledHeight) {
            if (!stackHeights.hasOwnProperty(_name4)) {
              stackHeights[_name4] = defaultHeight;
            }
          } else {
            stackHeights[_name4] = _height;
          }

          overviewViewportHeight += overviewHeight || 0;
        }

        // if there exists at least 1 overview, then add header
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

      if (overviewViewportHeight > 0) {
        overviewViewportHeight += overviewTimelineHeaderHeight;
      }

      var stackViewportHeight = height - overviewViewportHeight;
      var stackDividerHeights = children.length * 1;
      var totalStackHeight = stackViewportHeight - stackTimelineHeaderHeight - stackDividerHeights;
      var totalCollapsedHeight = 0;
      var containsRecentlyOpened = false;

      // handle computation as integers
      for (var name in stackHeights) {
        stackHeights[name] = Math.round(stackHeights[name] * totalStackHeight);
      }

      var _iteratorNormalCompletion3 = true;
      var _didIteratorError3 = false;
      var _iteratorError3 = undefined;

      try {
        for (var _iterator3 = (0, _getIterator3.default)(children), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
          var _ref12 = _step3.value;
          var _ref12$props = _ref12.props,
              _name5 = _ref12$props.name,
              collapsedHeight = _ref12$props.collapsedHeight;

          var wasCollapsed = lastStackCollapsed[_name5] || !lastStackCollapsed.hasOwnProperty(_name5);
          var isCollapsed = stackCollapsed[_name5];

          if (wasCollapsed && !isCollapsed) {
            var stackHeight = stackHeights[_name5];
            stackHeight = Math.max(collapsedHeight + 15, stackHeight);
            stackHeights[_name5] = stackHeight;
            containsRecentlyOpened = true;
          } else if (isCollapsed) {
            totalCollapsedHeight += collapsedHeight;
            // ignore
          } else if (stackHeights[_name5] < collapsedHeight + 10) {
            stackCollapsed[_name5] = true;
            totalCollapsedHeight += collapsedHeight;
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

      var accumulatedStackHeights = 0;
      var totalVisibleStackHeight = totalStackHeight - totalCollapsedHeight;

      if (containsRecentlyOpened) {
        var sortedVisibleChildren = children.filter(function (_ref6) {
          var name = _ref6.props.name;
          return !stackCollapsed[name] && stackCollapsed.hasOwnProperty(name);
        }).sort(function (a, b) {
          return stackHeights[b.props.name] - stackHeights[a.props.name];
        });

        var _iteratorNormalCompletion4 = true;
        var _didIteratorError4 = false;
        var _iteratorError4 = undefined;

        try {
          for (var _iterator4 = (0, _getIterator3.default)(sortedVisibleChildren), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
            var _ref8 = _step4.value;
            var _name2 = _ref8.props.name;

            accumulatedStackHeights += stackHeights[_name2];
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

        var totalStackTrim = accumulatedStackHeights - totalVisibleStackHeight;

        while (Math.round(totalStackTrim) > 0) {
          var totalTrimmedHeight = 0;
          var deltaAccumulatedStackHeights = 0;

          for (var i = 0, length = sortedVisibleChildren.length; i < length; i++) {
            var _sortedVisibleChildre = sortedVisibleChildren[i].props,
                _name = _sortedVisibleChildre.name,
                collapsedHeight = _sortedVisibleChildre.collapsedHeight;

            var stackWeight = stackHeights[_name] / accumulatedStackHeights;
            var trimStackHeight = Math.ceil(totalStackTrim * stackWeight);

            if (stackHeights[_name] - trimStackHeight > collapsedHeight + 10) {
              stackHeights[_name] -= trimStackHeight;
              totalTrimmedHeight += trimStackHeight;
              continue;
            }

            sortedVisibleChildren.splice(i++, 1);
            deltaAccumulatedStackHeights -= stackHeights[_name];
            length--;
          }

          totalStackTrim -= totalTrimmedHeight;
          accumulatedStackHeights -= totalTrimmedHeight;
          deltaAccumulatedStackHeights += deltaAccumulatedStackHeights;
        }
      }

      accumulatedStackHeights = 0;
      var _iteratorNormalCompletion5 = true;
      var _didIteratorError5 = false;
      var _iteratorError5 = undefined;

      try {
        for (var _iterator5 = (0, _getIterator3.default)(children), _step5; !(_iteratorNormalCompletion5 = (_step5 = _iterator5.next()).done); _iteratorNormalCompletion5 = true) {
          var _ref13 = _step5.value;
          var _name6 = _ref13.props.name;

          var _isCollapsed = stackCollapsed[_name6];

          if (!_isCollapsed) {
            if (accumulatedStackHeights + stackHeights[_name6] > totalVisibleStackHeight) {
              stackHeights[_name6] = totalVisibleStackHeight - accumulatedStackHeights;
            }

            accumulatedStackHeights += stackHeights[_name6];
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

      var lastVisibleStackName = null;
      var _iteratorNormalCompletion6 = true;
      var _didIteratorError6 = false;
      var _iteratorError6 = undefined;

      try {
        for (var _iterator6 = (0, _getIterator3.default)(children), _step6; !(_iteratorNormalCompletion6 = (_step6 = _iterator6.next()).done); _iteratorNormalCompletion6 = true) {
          var _ref14 = _step6.value;
          var _name7 = _ref14.props.name;

          var _isCollapsed2 = stackCollapsed[_name7];

          if (!_isCollapsed2) {
            lastVisibleStackName = _name7;
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

      if (lastVisibleStackName != null && accumulatedStackHeights < totalVisibleStackHeight) {
        stackHeights[lastVisibleStackName] += totalVisibleStackHeight - accumulatedStackHeights;
      }

      for (var _name3 in stackHeights) {
        stackHeights[_name3] /= totalStackHeight;
      }

      return {
        overviewViewportHeight: overviewViewportHeight,
        stackViewportHeight: stackViewportHeight,
        stackHeights: stackHeights,
        stackCollapsed: stackCollapsed,
        lastVisibleStackName: lastVisibleStackName,
        totalStackHeight: totalStackHeight
      };
    }
  }, {
    key: '_updateCanvasDPI',
    value: function _updateCanvasDPI() {
      _Canvas2.default.updateDPI();
    }
  }, {
    key: '_renderStackGrid',
    value: function _renderStackGrid() {
      var calculator = this.calculator;
      var _props2 = this.props,
          width = _props2.width,
          height = _props2.height,
          styles = _props2.styles,
          stackTimelineHeaderHeight = _props2.stackTimelineHeaderHeight;

      var gridContext = this.ref.grid.context;

      gridContext.clearRect(0, 0, width, height);

      calculator.drawGrid(gridContext, styles.stackGrid, height, 5, stackTimelineHeaderHeight, 1);
    }
  }, {
    key: '_renderOverviewGrid',
    value: function _renderOverviewGrid() {
      var calculator = this.calculator;
      var height = this.state.overviewViewportHeight;
      var _props3 = this.props,
          width = _props3.width,
          styles = _props3.styles,
          overviewTimelineHeaderHeight = _props3.overviewTimelineHeaderHeight;

      var overviewGridContext = this.ref.overviewGrid.context;

      overviewGridContext.clearRect(0, 0, width, height);

      calculator.drawGrid(overviewGridContext, styles.overviewGrid, height, 5, overviewTimelineHeaderHeight, 1);
    }
  }, {
    key: 'setCollapsed',
    value: function setCollapsed(name, collapse) {
      var _state = this.state,
          stackHeights = _state.stackHeights,
          stackCollapsed = _state.stackCollapsed;
      var onStackCollapse = this.props.onStackCollapse;


      if (typeof onStackCollapse === 'function') {
        onStackCollapse(name, collapse);
      } else {
        var contentHeights = this._getHeights(stackHeights, (0, _extends5.default)({}, stackCollapsed, (0, _defineProperty3.default)({}, name, collapse)));

        this.setState((0, _extends5.default)({}, contentHeights, { event: { name: 'size' } }));
      }
    }
  }, {
    key: 'setHeight',
    value: function setHeight(name, height) {
      var _state2 = this.state,
          stackHeights = _state2.stackHeights,
          stackCollapsed = _state2.stackCollapsed,
          totalStackHeight = _state2.totalStackHeight;
      var onStackHeightChange = this.props.onStackHeightChange;


      if (typeof onStackHeightChange === 'function') {
        onStackHeightChange(name, height);
      } else {
        var contentHeights = this._getHeights((0, _extends5.default)({}, stackHeights, (0, _defineProperty3.default)({}, name, height / totalStackHeight)), stackCollapsed);
        this.setState((0, _extends5.default)({}, contentHeights, { event: { name: 'size' } }));
      }
    }
  }, {
    key: 'componentDidUpdate',
    value: function componentDidUpdate() {
      var calculator = this.calculator;


      calculator.forceUpdate();
    }
  }, {
    key: 'componentDidMount',
    value: function componentDidMount() {
      var calculator = this.calculator,
          overviewCalculator = this.overviewCalculator;
      var _props4 = this.props,
          min = _props4.min,
          max = _props4.max,
          width = _props4.width,
          start = _props4.start;


      calculator.update({
        width: width,
        min: min,
        start: start,
        max: max,
        offsetMinRatio: 0,
        offsetMaxRatio: 0
      });

      overviewCalculator.update(calculator.props);
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      var calculator = this.calculator,
          overviewCalculator = this.overviewCalculator,
          dragListener = this.dragListener;


      calculator.removeListener('change', this.__renderStackGrid);
      overviewCalculator.removeListener('change', this.__renderOverviewGrid);

      dragListener.removeListener('start', this.__handleDragStart);
      dragListener.removeListener('drag', this.__handleDrag);
    }
  }, {
    key: 'componentWillReceiveProps',
    value: function componentWillReceiveProps(nextProps) {
      var calculator = this.calculator,
          overviewCalculator = this.overviewCalculator;
      var min = nextProps.min,
          max = nextProps.max,
          width = nextProps.width,
          height = nextProps.height,
          start = nextProps.start;
      var _state3 = this.state,
          stackHeights = _state3.stackHeights,
          stackCollapsed = _state3.stackCollapsed;


      var event = { name: 'size' };

      var contentHeights = this._getHeights(stackHeights, stackCollapsed, nextProps);

      if (this.props.width === width && this.props.height === height) {
        event = { name: 'data' };
      }

      this.setState((0, _extends5.default)({}, contentHeights, { event: event }), function () {
        calculator.update({
          width: width,
          start: start,
          min: min,
          max: max
        });

        overviewCalculator.update({
          width: width,
          start: start,
          min: min,
          max: max,
          offsetMinRatio: 0,
          offsetMaxRatio: 0
        });
      });
    }
  }, {
    key: 'componentWillMount',
    value: function componentWillMount() {
      var calculator = this.calculator,
          dragListener = this.dragListener,
          overviewCalculator = this.overviewCalculator;
      var _state4 = this.state,
          stackHeights = _state4.stackHeights,
          stackCollapsed = _state4.stackCollapsed;


      var contentHeights = this._getHeights(stackHeights, stackCollapsed);

      calculator.on('change', this.__renderStackGrid);
      overviewCalculator.on('change', this.__renderOverviewGrid);

      dragListener.on('start', this.__handleDragStart);
      dragListener.on('drag', this.__handleDrag);

      this.setState((0, _extends5.default)({}, contentHeights, { event: { name: 'data' } }));
    }
  }, {
    key: 'render',
    value: function render() {
      var _this2 = this;

      var _props5 = this.props,
          width = _props5.width,
          height = _props5.height,
          children = _props5.children,
          styles = _props5.styles,
          overviewTimelineHeaderHeight = _props5.overviewTimelineHeaderHeight,
          stackTimelineHeaderHeight = _props5.stackTimelineHeaderHeight;
      var _state5 = this.state,
          stackHeights = _state5.stackHeights,
          stackViewportHeight = _state5.stackViewportHeight,
          overviewViewportHeight = _state5.overviewViewportHeight,
          stackCollapsed = _state5.stackCollapsed,
          lastVisibleStackName = _state5.lastVisibleStackName,
          totalStackHeight = _state5.totalStackHeight;
      var overviewCalculator = this.overviewCalculator,
          calculator = this.calculator,
          dragListener = this.dragListener;


      var stackIdx = 0;
      var overviewCanvases = [];

      var stacks = _react2.default.Children.map(children, function (child, i) {
        var _child$props = child.props,
            name = _child$props.name,
            collapsedHeight = _child$props.collapsedHeight,
            overviewHeight = _child$props.overviewHeight;


        collapsedHeight = collapsedHeight || 0;

        var isCollapsed = stackCollapsed[name];
        var stackHeight = isCollapsed ? collapsedHeight : stackHeights[name] * totalStackHeight;

        var overviewCanvas = {};

        if (overviewHeight > 0) {
          overviewCanvases.push(_react2.default.createElement(_Canvas2.default, { key: i,
            className: 'overviewCanvas',
            width: width,
            height: overviewHeight,
            ref: function ref(_ref15) {
              return overviewCanvas.ref = _ref15 ? _ref15 : null;
            } }));
        }

        return _react2.default.cloneElement(child, {
          key: i,
          computedShowsOverview: overviewHeight > 0,
          computedHeight: stackHeight,
          computedCollapsed: isCollapsed,
          computedWidth: width,
          styles: child.props.styles || styles,
          setCollapsed: function setCollapsed(collapsed) {
            return _this2.setCollapsed(name, collapsed);
          },
          overviewCalculator: overviewCalculator,
          calculator: calculator,
          overviewCanvas: overviewCanvas
        });
      });

      var firstPane = true;
      var splitPanes = [_react2.default.createElement('div', { className: 'banner' })];

      for (var i = stacks.length - 1; i >= -1; i--) {
        var stack = stacks[i];

        if (splitPanes.length === 2) {
          var topPane = splitPanes[1];
          var bottomPane = splitPanes[0];

          var name = topPane.props.name;


          if (topPane.props.computedCollapsed || lastVisibleStackName === name) {
            var computedHeight = topPane.props.computedHeight;


            splitPanes = [_react2.default.createElement(
              _reactSplitPane2.default,
              { key: stackIdx++,
                split: 'horizontal',
                primary: 'first',
                minSize: computedHeight,
                maxSize: computedHeight,
                size: computedHeight,
                onChange: function onChange() {
                  return null;
                },
                resizerClassName: 'splitPaneResizer',
                resizerStyle: { pointerEvents: 'none' } },
              topPane,
              bottomPane
            )];
          } else {
            (function () {
              var _topPane$props = topPane.props,
                  computedHeight = _topPane$props.computedHeight,
                  name = _topPane$props.name;


              splitPanes = [_react2.default.createElement(
                _reactSplitPane2.default,
                { key: stackIdx++,
                  split: 'horizontal',
                  primary: 'first',
                  minSize: 0,
                  className: firstPane ? 'Panel1Only' : null,
                  resizerClassName: 'splitPaneResizer',
                  resizerStyle: firstPane ? { pointerEvents: 'none', display: 'none !important' } : null,
                  onChange: function onChange(size) {
                    return _this2.setHeight(name, size);
                  },
                  size: computedHeight },
                topPane,
                bottomPane
              )];
            })();
          }

          firstPane = false;
        }

        if (stack != null) {
          splitPanes.push(stack);
        }
      }

      return _react2.default.createElement(
        _radium.StyleRoot,
        null,
        _react2.default.createElement(_radium.Style, { scopeSelector: '.banner',
          rules: styles.banner }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.splitPaneResizer',
          rules: styles.splitPaneResizer }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.splitPaneResizer:hover',
          rules: styles.splitPaneResizer_hover }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.flameChart',
          rules: styles.flameChart }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.flameChart',
          rules: styles.scrollBars }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.stackWrapper',
          rules: styles.stackWrapper }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.stackGridCanvas',
          rules: styles.stackGridCanvas }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.overviewGridCanvas',
          rules: styles.overviewGridCanvas }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.stacks',
          rules: styles.stacks }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.overviewWrapper',
          rules: styles.overviewWrapper }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.overviewCanvas',
          rules: styles.overviewCanvas }),
        _react2.default.createElement(_radium.Style, { scopeSelector: '.SplitPane.Panel1Only.horizontal',
          rules: styles.splitPanePanel1Only }),
        _react2.default.createElement(
          'div',
          { className: 'flameChart', style: { width: width, height: height } },
          _react2.default.createElement(
            'div',
            { className: 'overviewWrapper', style: { width: width, height: overviewViewportHeight } },
            _react2.default.createElement(_Canvas2.default, { ref: function ref(_ref16) {
                return _this2.ref.overviewGrid = _ref16;
              },
              width: width,
              height: overviewViewportHeight,
              className: 'overviewGridCanvas' }),
            _react2.default.createElement(
              'div',
              { style: { position: 'absolute', top: overviewTimelineHeaderHeight, left: 0 } },
              overviewCanvases
            ),
            _react2.default.createElement(
              'div',
              { style: { position: 'absolute', top: 0, left: 0 } },
              _react2.default.createElement(_Curtain2.default, { height: overviewViewportHeight,
                width: width,
                styles: styles,
                calculator: calculator,
                onWheel: this._handleWheel.bind(this) })
            )
          ),
          _react2.default.createElement(
            'div',
            (0, _extends5.default)({ className: 'stackWrapper',
              style: { width: width, top: overviewViewportHeight }
            }, dragListener.handlers, {
              onWheel: this._handleWheel.bind(this) }),
            _react2.default.createElement(_Canvas2.default, { ref: function ref(_ref17) {
                return _this2.ref.grid = _ref17;
              },
              width: width,
              autoScale: true,
              height: stackViewportHeight,
              className: 'stackGridCanvas' }),
            _react2.default.createElement(
              'div',
              { className: 'stacks',
                style: { top: stackTimelineHeaderHeight } },
              splitPanes
            )
          )
        )
      );
    }
  }]);
  return FlameChart;
}(_react2.default.Component);

FlameChart.propTypes = {
  onStackHeightChange: PropTypes.func,
  onStackCollapse: PropTypes.func,
  start: PropTypes.number.isRequired,
  min: PropTypes.number.isRequired,
  max: PropTypes.number.isRequired,
  width: PropTypes.number.isRequired,
  height: PropTypes.number.isRequired,
  stackTimelineHeaderHeight: PropTypes.number,
  overviewTimelineHeaderHeight: PropTypes.number,
  styles: PropTypes.object,
  children: PropTypes.arrayOf(_react2.default.PropTypes.instanceOf(_Stack2.default))
};
FlameChart.defaultProps = {
  start: 0,
  width: 500,
  height: 500,
  stackTimelineHeaderHeight: 20,
  overviewTimelineHeaderHeight: 18,
  styles: _Themes2.default
};
exports.default = FlameChart;
;
