"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _getIterator2 = require("babel-runtime/core-js/get-iterator");

var _getIterator3 = _interopRequireDefault(_getIterator2);

exports.greedyStrategy = greedyStrategy;

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var compareEntries = function compareEntries(a, b) {
  return a.start === b.start ? b.end === a.end ? a.name.localeCompare(b.name) : b.end - a.end : a.start - b.start;
};

function greedyStrategy(entries) {
  var depths = new Array(20);

  entries = entries.sort(compareEntries);

  var maxDepth = 0;

  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    for (var _iterator = (0, _getIterator3.default)(entries), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      var entry = _step.value;
      var start = entry.start,
          end = entry.end;


      var depth = 0;
      var lastEntry = void 0;

      while (true) {
        lastEntry = depths[depth];

        if (lastEntry != null) {
          if (start < lastEntry.end && lastEntry.start <= end) {
            depth++;
            maxDepth = Math.max(maxDepth, depth);
            continue;
          }
        }

        entry.depth = depth;

        depths[depth] = entry;

        break;
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

  return { entries: entries, maxDepth: maxDepth };
}
