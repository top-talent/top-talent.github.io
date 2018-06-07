import React from 'react';
import ReactDOM from 'react-dom';
import DragListener from '../helpers/DragListener';
import { Style } from 'radium';

export default class Curtain extends React.Component {
  state = {};
  dragListener = new DragListener();
  dragListenerThumb = new DragListener(true, false);

  ref = {};

  _offsetMinRatio = null;
  _offsetMaxRatio = null;
  _curtainName = null;

  constructor(...args) {
    super(...args);

    this.__render = ::this._render;
    this.__handleDragStart = ::this._handleDragStart;
    this.__handleDrag = ::this._handleDrag;
    this.__handleDragThumb = ::this._handleDragThumb;
    this.__handleDragEndThumb = ::this._handleDragEndThumb;
  }

  _handleDragEndThumb() {
    const { curtain } = this.ref;

    DragListener.setDefaultCursor(curtain);
  }

  _handleDragStart(start, e) {
    const { calculator } = this.props;
    const { props: { offsetMinRatio, offsetMaxRatio } } = calculator;
    const { curtain } = this.ref;

    DragListener.setGrabCursor(curtain);

    this._offsetMinRatio = offsetMinRatio;
    this._offsetMaxRatio = offsetMaxRatio;
    this._curtainName = e.target.getAttribute('data-name');
  }

  _handleDragThumb(start, end, delta) {
    const { width, calculator } = this.props;
    const { _offsetMinRatio: offsetMinRatio, _offsetMaxRatio: offsetMaxRatio } = this;
    const { min, max } = calculator.props;
    const range = max - min;

    let offset = delta.x / width;

    if (this._curtainName === 'L') {
      const nextOffsetMinRatio = Math.min(Math.max(offsetMinRatio + offset, 0), 1 - offsetMaxRatio);

      if (((max - offsetMaxRatio * range) - (min + nextOffsetMinRatio * range)) / width <= 0.0005) {
        return;
      }

      calculator.update({
        offsetMinRatio: nextOffsetMinRatio
      });
    } else if (this._curtainName === 'R') {
      const nextOffsetMaxRatio = Math.min(Math.max(offsetMaxRatio - offset, 0), 1 - offsetMinRatio);

      if (((max - nextOffsetMaxRatio * range) - (min + offsetMinRatio * range)) / width <= 0.0005) {
        return;
      }

      calculator.update({
        offsetMaxRatio: nextOffsetMaxRatio
      });
    }
  }

  _handleDrag(start, end, delta) {
    const { width, calculator } = this.props;
    const { _offsetMinRatio: offsetMinRatio, _offsetMaxRatio: offsetMaxRatio } = this;

    let offset = delta.x / width;

    calculator.update({
      offsetMinRatio: Math.max(offsetMinRatio + offset, 0),
      offsetMaxRatio: Math.max(offsetMaxRatio - offset, 0)
    });
  }

  _render() {
    const { calculator: { props: { offsetMinRatio, offsetMaxRatio } } } = this.props;
    const { leftCurtain, rightCurtain } = this.ref;

    leftCurtain.style.width = `${offsetMinRatio * 100}%`;
    rightCurtain.style.width = `${offsetMaxRatio * 100}%`;
  }

  componentWillUnmount() {
    const { calculator } = this.props;
    const { dragListener, dragListenerThumb } = this;

    calculator.removeListener('change', this.__render);

    dragListener.removeListener('drag', this.__handleDrag);
    dragListener.removeListener('start', this.__handleDragStart);
    dragListenerThumb.removeListener('drag', this.__handleDragThumb);
    dragListenerThumb.removeListener('start', this.__handleDragStart);
    dragListenerThumb.removeListener('end', this.__handleDragEndThumb);
  }

  componentWillMount() {
    const { calculator } = this.props;
    const { dragListener, dragListenerThumb } = this;

    calculator.on('change', this.__render);

    dragListener.on('drag', this.__handleDrag);
    dragListener.on('start', this.__handleDragStart);
    dragListenerThumb.on('drag', this.__handleDragThumb);
    dragListenerThumb.on('start', this.__handleDragStart);
    dragListenerThumb.on('end', this.__handleDragEndThumb);
  }

  render() {
    const { width, height, styles, calculator, ...props } = this.props;
    const { offsetMinRatio, offsetMaxRatio } = calculator;
    const { dragListener, dragListenerThumb } = this;

    return (
      <div {...dragListener.handlers}>
        <Style scopeSelector='.curtains'
               rules={styles.curtains}/>
        <Style scopeSelector='.curtainLeft'
               rules={styles.curtainLeft}/>
        <Style scopeSelector='.curtainRight'
               rules={styles.curtainRight}/>
        <Style scopeSelector='.curtainLeftThumb'
               rules={styles.curtainLeftThumb}/>
        <Style scopeSelector='.curtainRightThumb'
               rules={styles.curtainRightThumb}/>
        <div className='curtains'
             style={{ width, height }}
             ref={ref => this.ref.curtain = ReactDOM.findDOMNode(ref)}
             {...props}
             onMouseLeave={dragListenerThumb.handlers.onMouseLeave}
             onMouseMove={dragListenerThumb.handlers.onMouseMove}
             onMouseUp={dragListenerThumb.handlers.onMouseUp}>
          <div className='curtainLeft'
               ref={ref => this.ref.leftCurtain = ReactDOM.findDOMNode(ref)}
               style={{ width: `${offsetMinRatio * 100}%` }}>
            <div className='curtainLeftThumb'
                 data-name='L'
                 onMouseDown={dragListenerThumb.handlers.onMouseDown}/>
          </div>
          <div className='curtainRight'
               ref={ref => this.ref.rightCurtain = ReactDOM.findDOMNode(ref)}
               style={{ width: `${offsetMaxRatio * 100}%` }}>
            <div className='curtainRightThumb'
                 data-name='R'
                 onMouseDown={dragListenerThumb.handlers.onMouseDown}/>
          </div>
        </div>
      </div>
    )
  }
}

