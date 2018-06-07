'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.Green = exports.Light = exports.Vibrant = exports.Cool = exports.Warm = exports.HSLColorGenerator = undefined;

var _map = require('babel-runtime/core-js/map');

var _map2 = _interopRequireDefault(_map);

var _classCallCheck2 = require('babel-runtime/helpers/classCallCheck');

var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);

var _createClass2 = require('babel-runtime/helpers/createClass');

var _createClass3 = _interopRequireDefault(_createClass2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function hashCode(string) {
  if (!string) {
    return 0;
  }

  // Hash algorithm for substrings is described in "Über die Komplexität der Multiplikation in
  // eingeschränkten Branchingprogrammmodellen" by Woelfe.
  // http://opendatastructures.org/versions/edition-0.1d/ods-java/node33.html#SECTION00832000000000000000
  var p = (1 << 30) * 4 - 5; // prime: 2^32 - 5
  var z = 0x5033d967; // 32 bits from random.org
  var z2 = 0x59d2f15d; // random odd 32 bit number
  var length = string.length;

  var s = 0;
  var zi = 1;

  for (var i = 0; i < length; i++) {
    var xi = string.charCodeAt(i) * z2;
    s = (s + zi * xi) % p;
    zi = zi * z % p;
  }

  s = (s + zi * (p - 1)) % p;

  return Math.abs(s | 0);
}

var HSLColorGenerator = exports.HSLColorGenerator = function () {
  function HSLColorGenerator(hueSpace, satSpace, lightnessSpace, alphaSpace) {
    (0, _classCallCheck3.default)(this, HSLColorGenerator);

    this._hueSpace = hueSpace || { min: 0, max: 360 };
    this._satSpace = satSpace || 67;
    this._lightnessSpace = lightnessSpace || 80;
    this._alphaSpace = alphaSpace || 1;
    this._colors = new _map2.default();
  }

  (0, _createClass3.default)(HSLColorGenerator, [{
    key: 'setColorForID',
    value: function setColorForID(id, color) {
      this._colors.set(id, color);
    }
  }, {
    key: 'colorForID',
    value: function colorForID(id) {
      var color = this._colors.get(id);

      if (!color) {
        color = this._generateColorForID(id);
        this._colors.set(id, color);
      }

      return color;
    }
  }, {
    key: '_generateColorForID',
    value: function _generateColorForID(id) {
      var hash = hashCode(id);
      var h = HSLColorGenerator._indexToValueInSpace(hash, this._hueSpace);
      var s = HSLColorGenerator._indexToValueInSpace(hash >> 8, this._satSpace);
      var l = HSLColorGenerator._indexToValueInSpace(hash >> 16, this._lightnessSpace);
      var a = HSLColorGenerator._indexToValueInSpace(hash >> 24, this._alphaSpace);
      return 'hsla(' + h + ', ' + s + '%, ' + l + '%, ' + a + ')';
    }
  }], [{
    key: '_indexToValueInSpace',
    value: function _indexToValueInSpace(index, space) {
      if (typeof space === 'number') {
        return space;
      }

      var count = space.count || space.max - space.min;

      index %= count;

      return space.min + Math.floor(index / (count - 1) * (space.max - space.min));
    }
  }]);
  return HSLColorGenerator;
}();

var Warm = exports.Warm = new HSLColorGenerator({ min: 30, max: 55 }, { min: 70, max: 100, count: 6 }, 50, 0.7);

var Cool = exports.Cool = new HSLColorGenerator({ min: 210, max: 300 }, { min: 70, max: 100, count: 6 }, 70, 0.7);

var Vibrant = exports.Vibrant = new HSLColorGenerator({ min: 30, max: 330 }, { min: 50, max: 80, count: 5 }, { min: 80, max: 90, count: 3 });

var Light = exports.Light = new HSLColorGenerator({ min: 30, max: 330 }, { min: 50, max: 80, count: 3 }, 85);

var Green = exports.Green = new HSLColorGenerator({ min: 120, max: 200 }, { min: 50, max: 80, count: 3 }, 50, 0.8);

exports.default = HSLColorGenerator;
