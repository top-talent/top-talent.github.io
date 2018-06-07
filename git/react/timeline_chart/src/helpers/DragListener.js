import EventEmitter from 'eventemitter3';

class DragListener extends EventEmitter {
  start = { x: 0, y: 0 };
  end = { x: 0, y: 0 };
  delta = { x: 0, y: 0 };

  isCapturing = false;
  dragged = false;
  handlers = {};
  stopPropagation = false;
  grabCursor = false;

  constructor(stopPropagation, grabCursor = true) {
    super();

    this.stopPropagation = stopPropagation;
    this.grabCursor = grabCursor;

    this.handlers = {
      onMouseUp: ::this.onMouseUp,
      onMouseLeave: ::this.onMouseLeave,
      onMouseMove: ::this.onMouseMove,
      onMouseDown: ::this.onMouseDown
    }
  }

  static setDefaultCursor(element) {
    element.style.cursor = 'default';
  }

  static setGrabCursor(element) {
    element.style.cursor = '-webkit-grabbing';
    element.style.cursor = '-moz-grabbing';
    element.style.cursor = 'grabbing';
  }

  onMouseUp(e) {
    if (this.isCapturing) {
      this.isCapturing = false;
      this.dragged = false;

      if (this.grabCursor) {
        DragListener.setDefaultCursor(e.target);
      }

      this.emit('end', e);

      e.preventDefault();
    }
  }

  onMouseOut = this.onMouseUp;
  onMouseLeave = this.onMouseUp;

  onMouseMove(e) {
    if (this.isCapturing) {
      this.dragged = true;

      const { delta, end, start } = this;

      end.x = e.nativeEvent.clientX;
      end.y = e.nativeEvent.clientY;

      delta.x = end.x - start.x;
      delta.y = end.y - start.y;

      this.emit('drag', start, end, delta, e);

      e.preventDefault();

      if (this.stopPropagation) {
        e.stopPropagation();
      }

      return true;
    }
  }

  onMouseDown(e) {
    const { start } =this;

    start.x = e.nativeEvent.clientX;
    start.y = e.nativeEvent.clientY;

    if (this.grabCursor) {
      DragListener.setGrabCursor(e.target);
    }

    this.isCapturing = true;

    this.emit('start', start, e);
  }
}

export default DragListener;
