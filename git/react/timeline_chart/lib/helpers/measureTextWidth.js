"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _map = require("babel-runtime/core-js/map");

var _map2 = _interopRequireDefault(_map);

exports.default = measureTextWidth;

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var textWidthCache = {};
var maxTextMeasureCacheLength = 200;

function measureTextWidth(context, text) {
  if (text.length > maxTextMeasureCacheLength) {
    return context.measureText(text).width;
  }

  var font = context.font;
  var textWidths = void 0;

  if (textWidthCache.hasOwnProperty(font) === false) {
    textWidthCache[font] = textWidths = new _map2.default();
  } else {
    textWidths = textWidthCache[font];
  }

  var width = textWidths.get(text);

  if (width == null) {
    var length = text.length;

    width = 0;

    for (var i = 0; i < length; i++) {
      var char = text[i];

      var charWidth = textWidths.get(char);

      if (charWidth == null) {
        charWidth = context.measureText(char).width;
        textWidths.set(char, charWidth);
      }

      width += charWidth;
    }

    textWidths.set(text, width);
  }

  return width;
}
