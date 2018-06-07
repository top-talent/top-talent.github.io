"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _classCallCheck2 = require("babel-runtime/helpers/classCallCheck");

var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Entry = function Entry() {
  (0, _classCallCheck3.default)(this, Entry);
  this.start = null;
  this.end = null;
  this.name = null;
  this.textFill = null;
  this.fill = null;
  this.overviewFill = null;
  this.timing = null;
  this.depth = 0;
  this.rect = { x: 0, y: 0, width: 0, height: 0 };
  this.visible = false;
  this.highlighted = false;
  this.selected = false;
};

exports.default = Entry;
