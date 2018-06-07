'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = getOptimalCanvasDPI;
/** @namespace window.devicePixelRatio */

var expectedRenderTimeMs = 0.1;

function getOptimalCanvasDPI() {
  if (window.devicePixelRatio > 1 && window.performance != null && typeof window.performance.now === 'function') {
    var canvas = document.createElement('canvas');
    canvas.height = 10 * window.devicePixelRatio;
    canvas.width = 10 * window.devicePixelRatio;
    canvas.style.height = 10 + 'px';
    canvas.style.width = 10 + 'px';

    var context = canvas.getContext('2d');
    context.height = 10 * window.devicePixelRatio;
    context.width = 10 * window.devicePixelRatio;
    context.scale(window.devicePixelRatio, window.devicePixelRatio);

    document.body.appendChild(canvas);

    var startTime = window.performance.now();
    for (var y = 0; y < 10; y++) {
      context.strokeStyle = 'rgba(0,0,0,0.1)';
      context.rect(0, y, 10, 1);
      context.stroke();
    }

    var time = window.performance.now() - startTime;

    document.body.removeChild(canvas);

    if (time > expectedRenderTimeMs) {
      return window.devicePixelRatio / (time / expectedRenderTimeMs);
    }

    return window.devicePixelRatio;
  }

  return window.devicePixelRatio || 1;
}
