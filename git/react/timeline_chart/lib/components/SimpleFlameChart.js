'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.SimpleFlameChart = exports.SimpleStack = undefined;

var _minSafeInteger = require('babel-runtime/core-js/number/min-safe-integer');

var _minSafeInteger2 = _interopRequireDefault(_minSafeInteger);

var _maxSafeInteger = require('babel-runtime/core-js/number/max-safe-integer');

var _maxSafeInteger2 = _interopRequireDefault(_maxSafeInteger);

var _getIterator2 = require('babel-runtime/core-js/get-iterator');

var _getIterator3 = _interopRequireDefault(_getIterator2);

var _map2 = require('babel-runtime/core-js/map');

var _map3 = _interopRequireDefault(_map2);

var _weakSet = require('babel-runtime/core-js/weak-set');

var _weakSet2 = _interopRequireDefault(_weakSet);

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

var _filter3 = require('lodash/fp/filter');

var _filter4 = _interopRequireDefault(_filter3);

var _map4 = require('lodash/fp/map');

var _map5 = _interopRequireDefault(_map4);

var _maxBy2 = require('lodash/maxBy');

var _maxBy3 = _interopRequireDefault(_maxBy2);

var _minBy2 = require('lodash/minBy');

var _minBy3 = _interopRequireDefault(_minBy2);

var _filter5 = require('lodash/filter');

var _filter6 = _interopRequireDefault(_filter5);

var _flow2 = require('lodash/flow');

var _flow3 = _interopRequireDefault(_flow2);

exports.renderSimpleFlameChart = renderSimpleFlameChart;
exports.unrenderSimpleFlameChart = unrenderSimpleFlameChart;
exports.injectSimpleFlameChartStyles = injectSimpleFlameChartStyles;

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _reactDimensions = require('react-dimensions');

var _reactDimensions2 = _interopRequireDefault(_reactDimensions);

var _FlameChart = require('./FlameChart');

var _FlameChart2 = _interopRequireDefault(_FlameChart);

var _Themes = require('./Themes');

var _HSLColorGenerator = require('../helpers/HSLColorGenerator');

var _rcCheckbox = require('rc-checkbox');

var _rcCheckbox2 = _interopRequireDefault(_rcCheckbox);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var SimpleStack = exports.SimpleStack = function (_React$Component) {
  (0, _inherits3.default)(SimpleStack, _React$Component);

  function SimpleStack() {
    (0, _classCallCheck3.default)(this, SimpleStack);
    return (0, _possibleConstructorReturn3.default)(this, (SimpleStack.__proto__ || (0, _getPrototypeOf2.default)(SimpleStack)).apply(this, arguments));
  }

  (0, _createClass3.default)(SimpleStack, [{
    key: 'render',
    value: function render() {
      throw Error('Should never render!');
    }
  }]);
  return SimpleStack;
}(_react2.default.Component);

SimpleStack.defaultProps = {
  name: null,
  types: [],
  getTimingColor: null,
  onTimingClick: null,
  isTimingSelected: null
};


var WrappedFlameChart = (0, _reactDimensions2.default)({
  elementResize: true,
  debounce: 800
})(function (_React$PureComponent) {
  (0, _inherits3.default)(WrappedFlameChart, _React$PureComponent);

  function WrappedFlameChart() {
    (0, _classCallCheck3.default)(this, WrappedFlameChart);
    return (0, _possibleConstructorReturn3.default)(this, (WrappedFlameChart.__proto__ || (0, _getPrototypeOf2.default)(WrappedFlameChart)).apply(this, arguments));
  }

  (0, _createClass3.default)(WrappedFlameChart, [{
    key: 'render',
    value: function render() {
      var _props = this.props,
          containerWidth = _props.containerWidth,
          containerHeight = _props.containerHeight,
          props = (0, _objectWithoutProperties3.default)(_props, ['containerWidth', 'containerHeight']);


      return _react2.default.createElement(_FlameChart2.default, (0, _extends3.default)({}, props, {
        width: containerWidth,
        height: containerHeight }));
    }
  }]);
  return WrappedFlameChart;
}(_react2.default.PureComponent));

var SimpleFlameChart = exports.SimpleFlameChart = function (_React$Component2) {
  (0, _inherits3.default)(SimpleFlameChart, _React$Component2);

  function SimpleFlameChart() {
    var _ref;

    var _temp, _this3, _ret;

    (0, _classCallCheck3.default)(this, SimpleFlameChart);

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    return _ret = (_temp = (_this3 = (0, _possibleConstructorReturn3.default)(this, (_ref = SimpleFlameChart.__proto__ || (0, _getPrototypeOf2.default)(SimpleFlameChart)).call.apply(_ref, [this].concat(args))), _this3), _this3.state = {
      highlighted: new _weakSet2.default(),
      highlightCount: 0,
      query: null,
      selected: new _weakSet2.default(),
      selectedCount: 0,
      visibility: new _map3.default()
    }, _temp), (0, _possibleConstructorReturn3.default)(_this3, _ret);
  }

  (0, _createClass3.default)(SimpleFlameChart, [{
    key: '_getTimingColor',
    value: function _getTimingColor(timing) {
      return _HSLColorGenerator.Warm.colorForID(timing.name);
    }
  }, {
    key: '_isTimingSelected',
    value: function _isTimingSelected(timing) {
      return this.isTimingSelected(timing);
    }
  }, {
    key: '_onTimingClick',
    value: function _onTimingClick(timing) {
      if (this.isTimingSelected(timing)) {
        this.setTimingSelected(timing, false);
        return;
      }

      this.setTimingSelected(null);
      this.setTimingSelected(timing, true);
    }
  }, {
    key: '_setGroupVisibility',
    value: function _setGroupVisibility(name, visible) {
      var visibility = this.state.visibility;


      visibility.set(name, visible);

      this.setState({ visibility: visibility });
    }
  }, {
    key: '_performSearch',
    value: function _performSearch(timings, query) {
      var highlightCount = 0;
      var highlighted = new _weakSet2.default();

      if (query != null) {
        var validatedQuery = String(query).trim().toLowerCase();

        if (validatedQuery.length > 0) {
          var _iteratorNormalCompletion = true;
          var _didIteratorError = false;
          var _iteratorError = undefined;

          try {
            for (var _iterator = (0, _getIterator3.default)(timings), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
              var timing = _step.value;

              var name = String(timing.name);

              if (name.toLowerCase().indexOf(validatedQuery) + 1) {
                highlightCount++;
                highlighted.add(timing);
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
      }

      this.setState({ highlighted: highlighted, highlightCount: highlightCount, query: query });
    }
  }, {
    key: 'isTimingSelected',
    value: function isTimingSelected(timing) {
      return timing == null ? this.state.selectedCount > 0 : this.state.selected.has(timing);
    }
  }, {
    key: 'setTimingSelected',
    value: function setTimingSelected(timing, select) {
      if (timing == null) {
        this.setState(function () {
          return { selected: new _weakSet2.default(), selectedCount: 0 };
        });
      } else {
        this.setState(function (state) {
          var selected = state.selected,
              selectedCount = state.selectedCount;


          if (select) {
            selected.add(timing);
            selectedCount++;
          } else if (selected.has(timing)) {
            selected.delete(timing);
            selectedCount--;
          }

          return { selected: selected, selectedCount: selectedCount };
        });
      }
    }
  }, {
    key: 'render',
    value: function render() {
      var _this4 = this;

      var _props2 = this.props,
          children = _props2.children,
          timings = _props2.timings,
          start = _props2.start,
          theme = _props2.theme;
      var _state = this.state,
          highlighted = _state.highlighted,
          highlightCount = _state.highlightCount,
          query = _state.query,
          visibility = _state.visibility;


      var provider = {
        entryStartGetter: function entryStartGetter(timing) {
          return timing.start;
        },
        entryEndGetter: function entryEndGetter(timing) {
          return timing.end;
        },
        entryNameGetter: function entryNameGetter(timing) {
          return timing.name;
        },
        entryHighlightedGetter: function entryHighlightedGetter(timing) {
          return highlighted.has(timing);
        }
      };

      var min = _maxSafeInteger2.default;
      var max = _minSafeInteger2.default;
      var visibleStackCount = 0;
      var idx = 0,
          idx2 = 0;
      var groupVisibilityToggles = [];

      var stacks = (0, _flow3.default)([(0, _map5.default)(function (_ref2) {
        var props = _ref2.props,
            _ref2$props = _ref2.props,
            _ref2$props$types = _ref2$props.types,
            types = _ref2$props$types === undefined ? [] : _ref2$props$types,
            name = _ref2$props.name;

        var currTimings = (0, _filter6.default)(timings, function (timing) {
          return types.includes(timing.type);
        });
        var currMin = (0, _minBy3.default)(currTimings, function (timing) {
          return timing.start;
        });
        var currMax = (0, _maxBy3.default)(currTimings, function (timing) {
          return timing.end;
        });
        var disabled = currTimings.length === 0;
        var visible = (!visibility.has(name) || visibility.get(name)) && !disabled;

        if (currMin != null) {
          min = Math.min(currMin.start, min);
        }

        if (currMax != null) {
          max = Math.max(currMax.end, max);
        }

        groupVisibilityToggles.push(_react2.default.createElement(
          'div',
          { className: 'simple-flamechart-group',
            key: idx2++ },
          _react2.default.createElement(_rcCheckbox2.default, { checked: visible,
            disabled: disabled,
            onChange: function onChange() {
              return _this4._setGroupVisibility(name, !visible);
            } }),
          _react2.default.createElement(
            'label',
            { style: { textDecoration: disabled && 'line-through' } },
            name
          )
        ));

        return { timings: currTimings, props: props, visible: visible };
      }), (0, _filter4.default)(function (_ref3) {
        var length = _ref3.timings.length,
            visible = _ref3.visible;
        return visible && length > 0 ? visibleStackCount += 1 : 0;
      }), (0, _map5.default)(function (_ref4) {
        var timings = _ref4.timings,
            _ref4$props = _ref4.props,
            name = _ref4$props.name,
            getTimingColor = _ref4$props.getTimingColor,
            isTimingSelected = _ref4$props.isTimingSelected,
            onTimingClick = _ref4$props.onTimingClick,
            props = (0, _objectWithoutProperties3.default)(_ref4$props, ['name', 'getTimingColor', 'isTimingSelected', 'onTimingClick']);

        return _react2.default.createElement(_FlameChart.Stack, (0, _extends3.default)({ key: idx++,
          name: name,
          timings: timings,
          defaultHeight: 1 / visibleStackCount
        }, provider, props, {
          entryFillGetter: getTimingColor || _this4._getTimingColor.bind(_this4),
          entrySelectedGetter: isTimingSelected || _this4._isTimingSelected.bind(_this4),
          onEntryClick: onTimingClick || _this4._onTimingClick.bind(_this4) }));
      })])(_react2.default.Children.toArray(children));

      if (start == null) {
        start = min;
      }

      return _react2.default.createElement(
        'div',
        { className: 'simple-flamechart ' + theme,
          style: { height: '100%', width: '100%' } },
        _react2.default.createElement(
          'div',
          { className: 'simple-flamechart-bar' },
          _react2.default.createElement(
            'div',
            { className: 'simple-flamechart-groups' },
            groupVisibilityToggles
          ),
          _react2.default.createElement('input', { className: 'simple-flamechart-search-box',
            placeholder: 'Search',
            value: query,
            onInput: function onInput(e) {
              return _this4._performSearch(timings, e.target.value);
            } }),
          query && _react2.default.createElement(
            'div',
            { className: 'simple-flamechart-search-count' },
            highlightCount,
            ' results'
          )
        ),
        _react2.default.createElement(
          WrappedFlameChart,
          { min: min - (min - start),
            max: max,
            styles: theme === 'dark' ? _Themes.Dark : _Themes.Light,
            start: start },
          stacks
        )
      );
    }
  }]);
  return SimpleFlameChart;
}(_react2.default.Component);

SimpleFlameChart.defaultProps = {
  theme: 'dark',
  timings: [],
  groups: []
};

;

function renderSimpleFlameChart(_ref5, element) {
  var _ref5$timings = _ref5.timings,
      timings = _ref5$timings === undefined ? [] : _ref5$timings,
      _ref5$stacks = _ref5.stacks,
      stacks = _ref5$stacks === undefined ? [] : _ref5$stacks,
      opts = (0, _objectWithoutProperties3.default)(_ref5, ['timings', 'stacks']);

  return _reactDom2.default.render(_react2.default.createElement(
    SimpleFlameChart,
    (0, _extends3.default)({ timings: timings
    }, opts),
    stacks.map(function (stack, i) {
      return _react2.default.createElement(SimpleStack, (0, _extends3.default)({}, stack, {
        key: i }));
    })
  ), element);
}

function unrenderSimpleFlameChart(element) {
  return _reactDom2.default.unmountComponentAtNode(element);
}

function injectSimpleFlameChartStyles() {
  return require('./SimpleFlameChart.less');
}

exports.default = SimpleFlameChart;
