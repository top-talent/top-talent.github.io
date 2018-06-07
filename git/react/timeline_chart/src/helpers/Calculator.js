import measureTextWidth from '../helpers/measureTextWidth';
import EventEmitter from 'eventemitter3';

export default class Calculator extends EventEmitter {
  static MinGridSlicePx = 64;

  props = {
    width: 0,
    paddingLeft: 0,
    start: 0,
    min: 0,
    max: 0,
    offsetMinRatio: 0,
    offsetMaxRatio: 0,
    offsetMin: 0,
    offsetMax: 0,
    timeToPixel: 0,
  };

  _updateId = null;

  constructor(...args) {
    super(...args);

    this.__update = () => {
      this._updateId = null;
      this.emit('change');
    };
  }

  forceUpdate() {
    if (this._updateId != null) {
      window.cancelAnimationFrame(this._updateId);
      this._updateId = null;
    }

    this._updateId = window.requestAnimationFrame(this.__update);
  }

  update(props) {
    const baseProps = this.props;

    Object.assign(baseProps, props);

    const { min, max, width, offsetMinRatio, offsetMaxRatio } = baseProps;
    const range = max - min;
    const offsetMin = min + offsetMinRatio * range;
    const offsetMax = max - offsetMaxRatio * range;

    baseProps.offsetMin = offsetMin;
    baseProps.offsetMax = offsetMax;
    baseProps.timeToPixel = width / (offsetMax - offsetMin);
    baseProps.offsetLeft = -(offsetMin - min) / (offsetMax - offsetMin) * width;

    this.forceUpdate();
  }

  getPosition(time) {
    const { offsetMin, timeToPixel, paddingLeft } = this.props;

    return Math.round((time - offsetMin) * timeToPixel + paddingLeft);
  }

  formatValue(value, precision) {
    return ((value - this.props.start)).toFixed(precision) + ' ms';
  }

  getDividerOffsets(freeZoneAtLeft = 0) {
    const { paddingLeft, start, offsetMax, offsetMin } = this.props;
    const offsetRange = offsetMax - offsetMin;

    const clientWidth = this.getPosition(offsetMax);
    const pixelsPerTime = clientWidth / offsetRange;

    let dividersCount = clientWidth / Calculator.MinGridSlicePx;
    let gridSliceTime = offsetRange / dividersCount;

    // Align gridSliceTime to a nearest round value.
    // We allow spans that fit into the formula: span = (1|2|5)x10^n,
    // e.g.: ...  .1  .2  .5  1  2  5  10  20  50  ...
    // After a span has been chosen make grid lines at multiples of the span.

    const logGridSliceTime = Math.ceil(Math.log(gridSliceTime) / Math.LN10);
    gridSliceTime = Math.pow(10, logGridSliceTime);

    if (gridSliceTime * pixelsPerTime >= 5 * Calculator.MinGridSlicePx) {
      gridSliceTime = gridSliceTime / 5;
    }

    if (gridSliceTime * pixelsPerTime >= 2 * Calculator.MinGridSlicePx) {
      gridSliceTime = gridSliceTime / 2;
    }

    const leftBoundaryTime = offsetMin - paddingLeft / pixelsPerTime;
    const firstDividerTime =
      Math.ceil((leftBoundaryTime - start) / gridSliceTime) * gridSliceTime + start;
    let lastDividerTime = offsetMax;

    // Add some extra space past the right boundary as the rightmost divider label text
    // may be partially shown rather than just pop up when a new rightmost divider gets into the view.
    lastDividerTime += Calculator.MinGridSlicePx / pixelsPerTime;
    dividersCount = Math.ceil((lastDividerTime - firstDividerTime) / gridSliceTime);

    if (!gridSliceTime) {
      dividersCount = 0;
    }

    const offsets = [];
    for (let i = 0; i < dividersCount; ++i) {
      let time = firstDividerTime + gridSliceTime * i;
      if (this.getPosition(time) < freeZoneAtLeft) {
        continue;
      }

      offsets.push(time);
    }

    return { offsets: offsets, precision: Math.max(0, -Math.floor(Math.log(gridSliceTime * 1.01) / Math.LN10)) };
  }

  drawGrid(context, styles, height, paddingTop, headerHeight, freeZoneAtLeft) {
    context.save();

    const { width } = this.props;
    const dividersData = this.getDividerOffsets();
    const dividerOffsets = dividersData.offsets;
    const precision = dividersData.precision;

    if (headerHeight) {
      context.fillStyle = styles.headerBackgroundFillStyle;
      context.fillRect(0, 0, width, headerHeight);
    }

    context.fillStyle = styles.headerTextFillStyle;
    context.strokeStyle = styles.gridStrokeStyle;
    context.textBaseline = 'hanging';
    context.font = styles.font;
    context.lineWidth = styles.gridLineWidth;

    context.translate(0.5, 0.5);

    const paddingRight = 4;

    for (let i = 0; i < dividerOffsets.length; ++i) {
      const time = dividerOffsets[i];
      const position = this.getPosition(time);
      context.moveTo(position, 0);
      context.lineTo(position, height);

      if (!headerHeight) {
        continue;
      }

      const text = this.formatValue(time, precision);
      const textWidth = measureTextWidth(context, text);
      const textPosition = position - textWidth - paddingRight;
      if (!freeZoneAtLeft || freeZoneAtLeft < textPosition) {
        context.fillText(text, textPosition, paddingTop);
      }
    }

    context.stroke();
    context.restore();
    context.beginPath();
  }
}
