'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.trimTextMiddle = trimTextMiddle;
exports.trimMiddle = trimMiddle;
exports.trimText = trimText;

var _measureTextWidth = require('./measureTextWidth');

var _measureTextWidth2 = _interopRequireDefault(_measureTextWidth);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function trimTextMiddle(context, text, maxWidth) {
  return trimText(context, text, maxWidth, trimMiddle);
}

function trimMiddle(text, maxLength) {
  var length = text.length;

  if (length <= maxLength) {
    return text;
  }

  var left = maxLength / 2;

  return text.substr(0, left) + '\u2026' + text.substr(length - left + 1);
}

function trimText(context, text, maxWidth, trimFunction) {
  var maxLength = 200;

  if (maxWidth <= 10) {
    return '';
  }

  if (text.length > maxLength) {
    text = trimFunction(text, maxLength);
  }

  var textWidth = (0, _measureTextWidth2.default)(context, text);

  if (textWidth <= maxWidth) {
    return text;
  }

  var l = 0;
  var r = text.length;
  var lv = 0;
  var rv = textWidth;

  while (l < r && lv !== rv && lv !== maxWidth) {
    var m = Math.ceil(l + (r - l) * (maxWidth - lv) / (rv - lv));
    var mv = (0, _measureTextWidth2.default)(context, trimFunction(text, m));
    if (mv <= maxWidth) {
      l = m;
      lv = mv;
    } else {
      r = m - 1;
      rv = mv;
    }
  }

  text = trimFunction(text, l);

  return text !== '\u2026' ? text : '';
}
