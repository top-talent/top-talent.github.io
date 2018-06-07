import React from 'react';
import ReactDOM from 'react-dom';

export default class Canvas extends React.Component {
  static DPI = (window.devicePixelRatio || 1) * 1000;
  static DPI_INC = 50;
  static DPI_DSC = 100;
  static PREFERRED_FRAME_TIME = 1000 / 60;
  static MIN_DPI = (window.devicePixelRatio * 0.75) * 1000 + Canvas.DPI_DSC;
  static MAX_DPI = (window.devicePixelRatio || 1) * 1000;
  static FRAME_GROUP_SIZE = 60;

  static canvasCount = 0;

  canvas = null;
  context = null;
  optimalDPI = Canvas.DPI;
  totalFrameTime = 0;
  frameCount = 0;
  lastDPI = null;

  static defaultProps = {
    autoScale: false
  };

  componentWillReceiveProps(nextProps) {
    if (this.props.autoScale && !nextProps.autoScale) {
      Canvas.canvasCount--;
    } else if (!this.props.autoScale && nextProps.autoScale) {
      Canvas.canvasCount++;
    }
  }

  componentWillMount() {
    if (this.props.autoScale) {
      Canvas.canvasCount++;
    }
  }

  componentWillUnmount() {
    if (this.props.autoScale) {
      Canvas.canvasCount--;
    }
  }

  static setDPI(canvas, context, width, height, dpi) {
    dpi = Math.round(dpi / 10) / 100;

    canvas.style.height = `${height}px`;
    canvas.style.width = `${width}px`;

    const scaledHeight = height * dpi;
    const scaledWidth = width * dpi;

    if (scaledHeight !== canvas.height) {
      canvas.height = scaledHeight;
      context.height = scaledHeight;
    }

    if (scaledWidth !== canvas.width) {
      canvas.width = scaledWidth;
      context.width = scaledWidth;
    }

    context.setTransform(1, 0, 0, 1, 0, 0);
    context.scale(dpi, dpi);
  }

  frameStart() {
    this.startTime = Date.now();

    const currDPI = this.optimalDPI;

    if (this.lastDPI !== currDPI) {
      const { context, canvas } = this;
      const { height, width } = this.props;

      Canvas.setDPI(canvas, context, width, height, currDPI);

      this.lastDPI = currDPI;
    }

    if (process.env.NODE_ENV !== 'production') {
      const { height } = this.props;
      const { context, frameCount, totalFrameTime } = this;
      const avgFrameTime = totalFrameTime / frameCount;
      const canvasCount = Canvas.canvasCount;
      const fps = 1000 / avgFrameTime / canvasCount;

      context.fillStyle = 'red';
      context.fillText(`DPI: ${currDPI}; FRAME: ${frameCount}; FPS: ${fps.toFixed(2)}`, 5, height - 5);
    }
  };

  frameEnd() {
    const frameTime = (Date.now() - this.startTime);
    const currDPI = this.optimalDPI;
    let totalFrameTime = this.totalFrameTime + frameTime;
    let frameCount = this.frameCount + 1;
    const avgFrameTime = totalFrameTime / frameCount;
    const canvasCount = Canvas.canvasCount;
    let nextDPI = this.optimalDPI;

    if (frameCount > Canvas.FRAME_GROUP_SIZE) {
      totalFrameTime = 0;
      frameCount = 0;
    } else if (avgFrameTime > (Canvas.PREFERRED_FRAME_TIME / canvasCount) && (currDPI - Canvas.DPI_DSC) >= Canvas.MIN_DPI) {
      nextDPI = currDPI - Canvas.DPI_DSC;
    } else if (avgFrameTime < (Canvas.PREFERRED_FRAME_TIME / canvasCount) && (currDPI + Canvas.DPI_INC) <= Canvas.MAX_DPI) {
      nextDPI = currDPI + Canvas.DPI_INC;
    }

    this.totalFrameTime = totalFrameTime;
    this.frameCount = frameCount;
    this.startTime = null;
    this.optimalDPI = nextDPI;
  };


  _createContext(ref) {
    if (ref == null) {
      return;
    }

    const { width, height } = this.props;
    const canvas = ReactDOM.findDOMNode(ref);
    const context = canvas.getContext('2d');

    Canvas.setDPI(canvas, context, width, height, this.optimalDPI);
    this.lastDPI = this.optimalDPI;

    context.startTime = null;

    this.canvas = canvas;
    this.context = context;
  }

  render() {
    const { autoScale, ...props } = this.props;

    return (
      <canvas ref={ref => this._createContext(ref)}
              {...props}/>
    )
  }
}