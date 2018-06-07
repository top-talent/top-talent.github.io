import React from 'react';
import ReactDOM from 'react-dom';
import { trimTextMiddle } from '../helpers/trim';
import measureTextWidth from '../helpers/measureTextWidth';
import Canvas from './Canvas';
import TooltipWrapper from './TooltipWrapper';
import Tooltip from './Tooltip';
import DragListener from '../helpers/DragListener';
import { Style } from 'radium';
import Entry from '../helpers/Entry';
import { greedyStrategy as setEntryDepthGreedily } from '../helpers/setEntryDepth';

const { PropTypes } = React;

export { Tooltip };

export default class Stack extends React.Component {
  static MOUSE_CLICK_TIMEOUT = 100;

  static propTypes = {
    name: PropTypes.string.isRequired,
    event: PropTypes.shape({ name: PropTypes.string }),
    styles: PropTypes.object,
    overviewType: PropTypes.oneOf(['default', 'spread']),
    tooltip: PropTypes.element,
    defaultHeight: PropTypes.oneOfType([PropTypes.number, PropTypes.string]).isRequired,
    height: PropTypes.oneOfType([PropTypes.number, PropTypes.string]),
    overviewHeight: PropTypes.number,
    collapsedHeight: PropTypes.number,
    defaultCollapsed: PropTypes.func,
    collapsed: PropTypes.bool,
    onEntryClick: PropTypes.func,
    entryHeight: PropTypes.number.isRequired,
    entryNameGetter: PropTypes.func.isRequired,
    entryStartGetter: PropTypes.func.isRequired,
    entryEndGetter: PropTypes.func.isRequired,
    entryFillGetter: PropTypes.func.isRequired,
    entryHighlightedGetter: PropTypes.func,
    entrySelectedGetter: PropTypes.func,
    entryTextFillGetter: PropTypes.func
  };

  static defaultProps = {
    defaultType: 1,
    computedHeight: null,
    defaultHeight: 100,
    overviewHeight: 10,
    collapsedHeight: 19,
    entryHeight: 17,
    overviewType: 'default',
    tooltip: <Tooltip />
  };

  _scrollTop = 0;
  _lastTooltipEntry = 0;
  _mouseDownTooltipTime = 0;

  scrollTop = 0;
  dragListener = new DragListener();

  ref = {};

  state = {
    maxDepth: 0,
    scrollTop: 0
  };

  constructor(...args) {
    super(...args);

    this.__renderChart = ::this._renderChart;
    this.__renderOverview = ::this._renderOverview;
    this.__handleDrag = ::this._handleDrag;
    this.__handleDragStart = ::this._handleDragStart;
  }

  _handleMouseLeave(e) {
    const { dragListener } = this;
    const { tooltipWrapper } = this.ref;

    dragListener.onMouseLeave(e);

    tooltipWrapper.setVisible(false);
  }

  _handleMouseMove(e) {
    const { dragListener } = this;
    const { tooltipWrapper } = this.ref;

    if (!dragListener.onMouseMove(e)) {
      const x = e.nativeEvent.offsetX;
      const y = e.nativeEvent.offsetY;

      const entry = this.getEntryAt(x, y);

      if (entry != null) {
        const { tooltip, styles } = this.props;

        if (entry !== this._lastTooltipEntry) {
          let tooltipContent = null;
          if (tooltip != null) {
            tooltipContent = React.cloneElement(tooltip, {
              entry,
              styles,
              timing: entry.timing
            });
          }

          this._lastTooltipEntry = entry;

          tooltipWrapper.setContent(tooltipContent);
        }

        tooltipWrapper.setVisible(true);
        tooltipWrapper.setPosition(x + 10, y + 10);
      } else {
        tooltipWrapper.setVisible(false);
      }
    } else {
      tooltipWrapper.setVisible(false);
    }
  }

  _handleScroll(e) {
    this.scrollTop = e.target.scrollTop;

    this._renderChart();

    e.stopPropagation();
  }

  _handleCollapse(e) {
    const { setCollapsed, computedCollapsed } = this.props;

    setCollapsed(!computedCollapsed);

    e.stopPropagation();
  }

  _handleDragStart() {
    this._scrollTop = this.scrollTop;
  }

  _handleDrag(start, end, delta) {
    const { scroller } = this.ref;
    const { scrollHeight, offsetHeight } = scroller;

    this._mouseDownTooltipTime = 0;

    scroller.scrollTop = Math.max(Math.min(this._scrollTop + -delta.y, scrollHeight - offsetHeight), 0);
  }

  _handleTooltipMouseDown() {
    this._mouseDownTooltipTime = Date.now();
  }

  _handleTooltipMouseUp(e) {
    if (Date.now() - this._mouseDownTooltipTime <= Stack.MOUSE_CLICK_TIMEOUT) {
      const { onEntryClick } = this.props;

      if (onEntryClick != null) {
        const { offsetX: x, offsetY: y } = e.nativeEvent;

        const entry = this.getEntryAt(x, y);

        if (entry != null) {
          onEntryClick(entry.timing, entry, e);
        }
      }
    }
  }

  getEntryAt(x, y) {
    const { entries } = this.state;

    for (const entry of entries) {
      const { visible, rect } = entry;
      if (visible === false) {
        continue;
      }

      if (
        x >= rect.x && x <= (rect.x + rect.width) &&
        y >= rect.y && y <= (rect.y + rect.height)
      ) {
        return entry;
      }
    }
  }

  createEntries(props) {
    const {
      entryStartGetter,
      entryEndGetter,
      entryNameGetter,
      entryFillGetter,
      entrySelectedGetter,
      entryHighlightedGetter,
      entryTextFillGetter
    } = props;

    const { timings } = props;
    const length = timings.length;
    const entries = new Array(length);

    for (let i = 0; i < length; i++) {
      const timing = timings[i];
      const entry = new Entry(); // TODO cache these?
      const start = entryStartGetter(timing);
      const end = entryEndGetter(timing);
      const name = String(entryNameGetter(timing));
      const fill = entryFillGetter(timing, 'default');
      const overviewFill = entryFillGetter(timing, 'overview');

      entry.start = start;
      entry.end = end;
      entry.name = name;
      entry.textFill = entryTextFillGetter != null && entryTextFillGetter(timing, entry)
      entry.fill = fill;
      entry.overviewFill = overviewFill;
      entry.timing = timing;
      entry.selected = entrySelectedGetter != null && entrySelectedGetter(timing, entry);
      entry.highlighted = entryHighlightedGetter != null && entryHighlightedGetter(timing, entry);

      entries[i] = entry;
    }

    return setEntryDepthGreedily(entries);
  }

  _computeEntryRects() {
    const { entries } = this.state;
    const { computedWidth: width, calculator, computedHeight: height, styles } = this.props;

    const entryHeight = styles.stackEntry.height;
    const { min, offsetMin, offsetMax, offsetLeft: scrollLeft } = calculator.props;
    const scrollTop = this.scrollTop;
    const offsetRange = offsetMax - offsetMin;

    for (const entry of entries) {
      const { depth, rect, start, end } = entry;
      const x = (start - min) / offsetRange * width + scrollLeft;
      const y = depth * entryHeight + 18 - scrollTop;

      let entryWidth = Math.round((end - start) / offsetRange * width);
      let visibleWidth = x < 0 ? x + entryWidth : entryWidth;

      entry.visible = false;

      if (x + visibleWidth > width) {
        visibleWidth -= x + visibleWidth - width;
      }

      if (visibleWidth <= 0) {
        continue;
      }

      visibleWidth = Math.max(3, visibleWidth);

      if (x > width) {
        continue;
      }

      if (y > height) {
        continue;
      }

      entry.visible = true;

      rect.x = Math.max(x, 0) + 0.5;
      rect.y = y + 0.5;
      rect.height = entryHeight;
      rect.width = visibleWidth;
    }
  }

  _renderBackground() {
    const { context } = this.ref.chart;
    const { styles, computedHeight: height } = this.props;
    const { entries } = this.state;

    context.beginPath();

    context.fillStyle = styles.stackEntrySelected.backdropFillStyle;

    for (const entry of entries) {
      const { visible } = entry;
      if (visible) {
        const { rect: { x, width: entryWidth }, highlighted, selected } = entry;
        if (selected) {
          context.fillRect(x, 0, entryWidth, height);
        } else if (highlighted) {
          context.rect(x, 0, entryWidth, height);
        }
      }
    }

    context.fillStyle = styles.stackEntryHighlighted.backdropFillStyle;

    context.fill();
    context.closePath();
  }

  _renderContent() {
    const { context } = this.ref.chart;
    const { styles } = this.props;
    const { entries } = this.state;

    context.beginPath();

    context.textBaseline = 'alphabetic';
    context.font = styles.stackEntry.font;

    const minTextWidth = measureTextWidth(context, '-');

    for (let { rect: { x, y, width: entryWidth, height: entryHeight }, visible, textFill, fill, name, highlighted, selected } of entries) {
      if (visible) {
        if (selected) {
          context.fillStyle = styles.stackEntrySelected.fillStyle;
          context.fillRect(x, y, entryWidth - 1, entryHeight);
          context.fillStyle = styles.stackEntrySelected.textFillStyle;
        } else if (highlighted) {
          context.fillStyle = styles.stackEntryHighlighted.fillStyle;
          context.fillRect(x, y, entryWidth - 1, entryHeight);
          context.fillStyle = styles.stackEntryHighlighted.textFillStyle;
        } else {
          context.fillStyle = fill;
          context.fillRect(x, y, entryWidth - 1, entryHeight);
          context.rect(x, y, entryWidth, entryHeight);
          context.fillStyle = textFill || styles.stackEntry.textFillStyle;
        }

        if (entryWidth > minTextWidth) {
          const textStart = Math.max(x, 0);
          const textWidth = entryWidth;
          const textBaseHeight = entryHeight - styles.stackEntry.textBaseline;
          const trimmedText = trimTextMiddle(context, name, textWidth - 2 * styles.stackEntry.textPadding);

          if (trimmedText.length > 0) {
            context.fillText(trimmedText, textStart + styles.stackEntry.textPadding, y + textBaseHeight);
          }
        }
      }
    }

    context.strokeStyle = styles.stackEntry.strokeStyle;

    context.stroke();
    context.closePath();
  }

  _renderForeground() {
    const { context } = this.ref.chart;
    const { styles } = this.props;
    const { entries } = this.state;

    context.beginPath();

    context.strokeStyle = styles.stackEntrySelected.strokeStyle;

    for (const entry of entries) {
      const { visible } = entry;
      if (visible) {
        const { rect: { x, y, width: entryWidth, height: entryHeight }, selected, highlighted } = entry;
        if (selected) {
          context.strokeRect(x + 0.5, y, entryWidth - 0.5, entryHeight);
        } else if (highlighted) {
          context.rect(x + 0.5, y, entryWidth - 0.5, entryHeight);
        }
      }
    }

    context.strokeStyle = styles.stackEntryHighlighted.strokeStyle;

    context.stroke();
    context.closePath();
  }

  _renderChart() {
    const { chart, chart: { context } } = this.ref;
    const { computedWidth: width, computedHeight: height, computedCollapsed } = this.props;

    context.clearRect(0, 0, width, height);

    if (computedCollapsed) {
      return;
    }

    this._computeEntryRects();

    chart.frameStart();

    this._renderBackground();
    this._renderContent();
    this._renderForeground();

    chart.frameEnd();
  }

  _renderOverview() {
    const { computedShowsOverview } = this.props;

    if (computedShowsOverview === false) {
      return;
    }

    const { entries, maxDepth } = this.state;
    const { computedWidth: width, overviewType, overviewHeight: height, overviewCalculator, overviewCanvas: { ref: { context } } } = this.props;

    const { min, max } = overviewCalculator.props;
    const range = max - min;

    context.clearRect(0, 0, width, height);
    context.beginPath();

    for (const { overviewFill, timing, depth } of entries) {
      const x = (timing.start - min) / range * width;
      const entryWidth = (timing.end - timing.start) / range * width;

      context.fillStyle = overviewFill;

      if (overviewType === 'spread') {
        context.fillRect(x, 0, entryWidth, depth / maxDepth * height);
      } else {
        context.fillRect(x, Math.floor(depth / maxDepth * height), entryWidth, Math.ceil(1 / maxDepth * height));
      }
    }

    context.closePath();
  }

  componentWillUnmount() {
    const { calculator, overviewCalculator } = this.props;
    const { dragListener } = this;

    calculator.removeListener('change', this.__renderChart);
    overviewCalculator.removeListener('change', this.__renderOverview);

    dragListener.removeListener('start', this.__handleDragStart);
    dragListener.removeListener('drag', this.__handleDrag);
  }

  componentWillMount() {
    const entryInfo = this.createEntries(this.props);
    const { calculator, overviewCalculator } = this.props;
    const { dragListener } = this;

    calculator.on('change', this.__renderChart);
    overviewCalculator.on('change', this.__renderOverview);

    dragListener.on('start', this.__handleDragStart);
    dragListener.on('drag', this.__handleDrag);

    this.setState(entryInfo);
  }

  componentWillReceiveProps(nextProps) {
    const entryInfo = this.createEntries(nextProps);

    this.setState(entryInfo);
  }

  rerender() {
    this._renderChart();
  }

  render() {
    const { dragListener } = this;
    const { maxDepth } = this.state;
    const { computedWidth: width, computedHeight: height, name, computedCollapsed, styles, children } = this.props;
    const entryHeight = styles.stackEntry.height;
    const contentHeight = computedCollapsed ? 0 : entryHeight * (maxDepth + 1) + 18 + 2;

    return (
      <div style={{ position: 'relative' }}
           onMouseUp={::this._handleTooltipMouseUp}
           onMouseDown={::this._handleTooltipMouseDown}>
        <Style scopeSelector='.stackSearch'
               rules={styles.stackSearch}/>
        <Style scopeSelector='.stackHeader'
               rules={styles.stackHeader}/>
        <Style scopeSelector='.stackTitle'
               rules={styles.stackTitle}/>
        <Style scopeSelector='.stackArrow'
               rules={styles.stackArrow}/>
        <Style scopeSelector='.stackScroller'
               rules={styles.stackScroller}/>
        <Style scopeSelector='.stackCanvas'
               rules={styles.stackCanvas}/>
        <Style scopeSelector='.stackTitleGroup'
               rules={styles.stackTitleGroup}/>
        <TooltipWrapper ref={ref => this.ref.tooltipWrapper = ref}
                        width={width}
                        height={height}
                        styles={styles}/>
        <div style={{ height, width, position: 'relative', userSelect: 'none' }}
             {...dragListener.handlers}
             onMouseLeave={::this._handleMouseLeave}
             onMouseMove={::this._handleMouseMove}>
          <Canvas ref={ref => this.ref.chart = ref}
                  className='stackCanvas'
                  width={width}
                  autoScale={true}
                  height={height}/>
          { contentHeight > height &&
          <div className='stackScroller'
               ref={ref => this.ref.scroller = ReactDOM.findDOMNode(ref)}
               onWheel={e => e.stopPropagation()}
               onScroll={::this._handleScroll}>
            <div style={{ width, height: contentHeight }}/>
          </div> }
          <div className='stackHeader'>
            <div>
              <div className='stackTitleGroup'
                   onClick={::this._handleCollapse}>
                <div className='stackArrow'>{computedCollapsed ? '▶' : '▼'}</div>
                <div className='stackTitle'>{name}</div>
              </div>
            </div>
          </div>
        </div>
        {children}
      </div>
    );
  }
}
