/** @namespace window.devicePixelRatio */

const expectedRenderTimeMs = 0.1;

export default function getOptimalCanvasDPI() {
  if (window.devicePixelRatio > 1 && window.performance != null && typeof window.performance.now === 'function') {
    const canvas = document.createElement('canvas');
    canvas.height = 10 * window.devicePixelRatio;
    canvas.width = 10 * window.devicePixelRatio;
    canvas.style.height = `${10}px`;
    canvas.style.width = `${10}px`;

    const context = canvas.getContext('2d');
    context.height = 10 * window.devicePixelRatio;
    context.width = 10 * window.devicePixelRatio;
    context.scale(window.devicePixelRatio, window.devicePixelRatio);

    document.body.appendChild(canvas);

    const startTime = window.performance.now();
    for (let y = 0; y < 10; y++) {
      context.strokeStyle = 'rgba(0,0,0,0.1)';
      context.rect(0, y, 10, 1);
      context.stroke();
    }

    const time = window.performance.now() - startTime;

    document.body.removeChild(canvas);

    if (time > expectedRenderTimeMs) {
      return window.devicePixelRatio / (time / expectedRenderTimeMs);
    }

    return window.devicePixelRatio;
  }

  return window.devicePixelRatio || 1;
}
