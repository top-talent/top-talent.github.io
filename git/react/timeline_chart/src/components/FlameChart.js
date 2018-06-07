import React from 'react';
import Canvas from './Canvas';
import Stack from './Stack';
import Curtain from './Curtain';
import DragListener from '../helpers/DragListener';
import SplitPane from 'react-split-pane';
import defaultStyles from './Themes';
import { Style, StyleRoot } from 'radium';
import Calculator from '../helpers/Calculator';

const { PropTypes } = React;

export { Stack };

export default class FlameChart extends React.Component {
  static propTypes = {
    onStackHeightChange: PropTypes.func,
    onStackCollapse: PropTypes.func,
    start: PropTypes.number.isRequired,
    min: PropTypes.number.isRequired,
    max: PropTypes.number.isRequired,
    width: PropTypes.number.isRequired,
    height: PropTypes.number.isRequired,
    stackTimelineHeaderHeight: PropTypes.number,
    overviewTimelineHeaderHeight: PropTypes.number,
    styles: PropTypes.object,
    children: PropTypes.arrayOf(React.PropTypes.instanceOf(Stack)),
  };

  static defaultProps = {
    start: 0,
    width: 500,
    height: 500,
    stackTimelineHeaderHeight: 20,
    overviewTimelineHeaderHeight: 18,
    styles: defaultStyles
  };

  _offsetMinRatio = 0;
  _offsetMaxRatio = 0;

  dragListener = new DragListener();
  calculator = new Calculator();
  overviewCalculator = new Calculator();

  ref = {};

  state = {
    stackHeights: {},
    stackCollapsed: {},
    scrollLeft: 0
  };

  constructor(...args) {
    super(...args);

    this.__renderStackGrid = ::this._renderStackGrid;
    this.__renderOverviewGrid = ::this._renderOverviewGrid;
    this.__handleDrag = ::this._handleDrag;
    this.__handleDragStart = ::this._handleDragStart;
  }

  _handleDragStart() {
    const { calculator: { props: { offsetMinRatio, offsetMaxRatio } } } = this;

    this._offsetMinRatio = offsetMinRatio;
    this._offsetMaxRatio = offsetMaxRatio;
  }

  _handleDrag(start, end, delta) {
    const { calculator } = this;
    const { width } = this.props;
    const { _offsetMinRatio: offsetMinRatio, _offsetMaxRatio: offsetMaxRatio } = this;

    const rate = (1 - (offsetMinRatio + offsetMaxRatio)) ** 1.1;

    let cropOffsetX = delta.x / width * rate;

    if (offsetMinRatio - cropOffsetX < 0) {
      cropOffsetX = offsetMinRatio;
    }

    if (offsetMaxRatio + cropOffsetX < 0) {
      cropOffsetX += Math.abs(offsetMaxRatio + cropOffsetX);
    }

    calculator.update({
      offsetMinRatio: offsetMinRatio - cropOffsetX,
      offsetMaxRatio: offsetMaxRatio + cropOffsetX
    });
  }

  _handleWheel(e) {
    e.preventDefault();

    if (e.deltaY === 0) {
      return;
    }

    const { width, min, max } = this.props;
    const { calculator, calculator: { props: { offsetMinRatio, offsetMaxRatio } } } = this;

    const ratio = e.nativeEvent.offsetX / width;
    const rate = (1 - (offsetMinRatio + offsetMaxRatio)) ** 1.1;

    const nextOffsetMinRatio = Math.max(0, offsetMinRatio + e.deltaY / width * ratio * rate);
    const nextOffsetMaxRatio = Math.max(0, offsetMaxRatio + e.deltaY / width * (1 - ratio) * rate);
    const range = max - min;

    if (((max - nextOffsetMaxRatio * range) - (min + nextOffsetMinRatio * range)) / width <= 0.0005) {
      return;
    }

    calculator.update({
      offsetMinRatio: nextOffsetMinRatio,
      offsetMaxRatio: nextOffsetMaxRatio
    });
  }

  _getHeights(stackHeights, stackCollapsed, props = this.props) {
    stackHeights = { ...stackHeights };
    stackCollapsed = { ...stackCollapsed };

    let { children } = props;
    const { height, stackTimelineHeaderHeight, overviewTimelineHeaderHeight, onStackHeightChange, onStackCollapse } = props;
    const { stackCollapsed: lastStackCollapsed = {} } = this.state;

    let overviewViewportHeight = 0;

    children = React.Children.toArray(children);

    nextName: for (const k in stackCollapsed) {
      for (const { props: { name } } of children) {
        if (k === name) {
          continue nextName;
        }
      }

      delete stackCollapsed[k];
    }

    for (const { props: { name, defaultHeight, height, overviewHeight, defaultCollapsed, collapsed } } of children) {
      const isControlledCollapse = collapsed != null && onStackCollapse != null;

      if (!isControlledCollapse) {
        if (!stackCollapsed.hasOwnProperty(name)) {
          stackCollapsed[name] = defaultCollapsed || false;
        }
      } else {
        stackCollapsed[name] = collapsed;
      }

      const isControlledHeight = height != null && onStackHeightChange != null;

      if (!isControlledHeight) {
        if (!stackHeights.hasOwnProperty(name)) {
          stackHeights[name] = defaultHeight;
        }
      } else {
        stackHeights[name] = height;
      }

      overviewViewportHeight += overviewHeight || 0;
    }

    // if there exists at least 1 overview, then add header
    if (overviewViewportHeight > 0) {
      overviewViewportHeight += overviewTimelineHeaderHeight;
    }

    let stackViewportHeight = height - overviewViewportHeight;
    let stackDividerHeights = children.length * 1;
    let totalStackHeight = stackViewportHeight - stackTimelineHeaderHeight - stackDividerHeights;
    let totalCollapsedHeight = 0;
    let containsRecentlyOpened = false;

    // handle computation as integers
    for (const name in stackHeights) {
      stackHeights[name] = Math.round(stackHeights[name] * totalStackHeight);
    }

    for (const { props: { name, collapsedHeight } } of children) {
      const wasCollapsed = lastStackCollapsed[name] || !lastStackCollapsed.hasOwnProperty(name);
      const isCollapsed = stackCollapsed[name];

      if (wasCollapsed && !isCollapsed) {
        let stackHeight = stackHeights[name];
        stackHeight = Math.max(collapsedHeight + 15, stackHeight);
        stackHeights[name] = stackHeight;
        containsRecentlyOpened = true;
      } else if (isCollapsed) {
        totalCollapsedHeight += collapsedHeight;
        // ignore
      } else if (stackHeights[name] < collapsedHeight + 10) {
        stackCollapsed[name] = true;
        totalCollapsedHeight += collapsedHeight;
      }
    }

    let accumulatedStackHeights = 0;
    let totalVisibleStackHeight = totalStackHeight - totalCollapsedHeight;

    if (containsRecentlyOpened) {
      let sortedVisibleChildren = children.filter(({ props: { name } }) => !stackCollapsed[name] && stackCollapsed.hasOwnProperty(name))
                                          .sort((a, b) => stackHeights[b.props.name] - stackHeights[a.props.name]);

      for (const { props: { name } } of sortedVisibleChildren) {
        accumulatedStackHeights += stackHeights[name];
      }

      let totalStackTrim = accumulatedStackHeights - totalVisibleStackHeight;

      while (Math.round(totalStackTrim) > 0) {
        let totalTrimmedHeight = 0;
        let deltaAccumulatedStackHeights = 0;

        for (let i = 0, length = sortedVisibleChildren.length; i < length; i++) {
          const { props: { name, collapsedHeight } } = sortedVisibleChildren[i];
          const stackWeight = stackHeights[name] / accumulatedStackHeights;
          const trimStackHeight = Math.ceil(totalStackTrim * stackWeight);

          if (stackHeights[name] - trimStackHeight > collapsedHeight + 10) {
            stackHeights[name] -= trimStackHeight;
            totalTrimmedHeight += trimStackHeight;
            continue;
          }

          sortedVisibleChildren.splice(i++, 1);
          deltaAccumulatedStackHeights -= stackHeights[name];
          length--;
        }

        totalStackTrim -= totalTrimmedHeight;
        accumulatedStackHeights -= totalTrimmedHeight;
        deltaAccumulatedStackHeights += deltaAccumulatedStackHeights;
      }
    }

    accumulatedStackHeights = 0;
    for (const { props: { name } } of children) {
      const isCollapsed = stackCollapsed[name];

      if (!isCollapsed) {
        if (accumulatedStackHeights + stackHeights[name] > totalVisibleStackHeight) {
          stackHeights[name] = totalVisibleStackHeight - accumulatedStackHeights;
        }

        accumulatedStackHeights += stackHeights[name];
      }
    }

    let lastVisibleStackName = null;
    for (const { props: { name } } of children) {
      const isCollapsed = stackCollapsed[name];

      if (!isCollapsed) {
        lastVisibleStackName = name;
      }
    }

    if (lastVisibleStackName != null && accumulatedStackHeights < totalVisibleStackHeight) {
      stackHeights[lastVisibleStackName] += totalVisibleStackHeight - accumulatedStackHeights;
    }

    for (const name in stackHeights) {
      stackHeights[name] /= totalStackHeight;
    }

    return {
      overviewViewportHeight: overviewViewportHeight,
      stackViewportHeight: stackViewportHeight,
      stackHeights: stackHeights,
      stackCollapsed: stackCollapsed,
      lastVisibleStackName,
      totalStackHeight
    }
  }

  _updateCanvasDPI() {
    Canvas.updateDPI();
  }

  _renderStackGrid() {
    const { calculator } = this;
    const { width, height, styles, stackTimelineHeaderHeight } = this.props;
    const gridContext = this.ref.grid.context;

    gridContext.clearRect(0, 0, width, height);

    calculator.drawGrid(gridContext, styles.stackGrid, height, 5, stackTimelineHeaderHeight, 1);
  }

  _renderOverviewGrid() {
    const { calculator } = this;
    const { overviewViewportHeight: height } = this.state;
    const { width, styles, overviewTimelineHeaderHeight } = this.props;
    const overviewGridContext = this.ref.overviewGrid.context;

    overviewGridContext.clearRect(0, 0, width, height);

    calculator.drawGrid(overviewGridContext, styles.overviewGrid, height, 5, overviewTimelineHeaderHeight, 1);
  }

  setCollapsed(name, collapse) {
    const { stackHeights, stackCollapsed }  = this.state;
    const { onStackCollapse } = this.props;

    if (typeof onStackCollapse === 'function') {
      onStackCollapse(name, collapse);
    } else {
      const contentHeights = this._getHeights(stackHeights, {
        ...stackCollapsed,
        [name]: collapse
      });

      this.setState({ ...contentHeights, event: { name: 'size' } });
    }
  }

  setHeight(name, height) {
    const { stackHeights, stackCollapsed, totalStackHeight }  = this.state;
    const { onStackHeightChange } = this.props;

    if (typeof onStackHeightChange === 'function') {
      onStackHeightChange(name, height);
    } else {
      const contentHeights = this._getHeights({ ...stackHeights, [name]: height / totalStackHeight }, stackCollapsed);
      this.setState({ ...contentHeights, event: { name: 'size' } });
    }
  }

  componentDidUpdate() {
    const { calculator } = this;

    calculator.forceUpdate();
  }

  componentDidMount() {
    const { calculator, overviewCalculator } = this;
    const { min, max, width, start } = this.props;

    calculator.update({
      width,
      min,
      start,
      max,
      offsetMinRatio: 0,
      offsetMaxRatio: 0
    });

    overviewCalculator.update(calculator.props);
  }

  componentWillUnmount() {
    const { calculator, overviewCalculator, dragListener } = this;

    calculator.removeListener('change', this.__renderStackGrid);
    overviewCalculator.removeListener('change', this.__renderOverviewGrid);

    dragListener.removeListener('start', this.__handleDragStart);
    dragListener.removeListener('drag', this.__handleDrag);
  }

  componentWillReceiveProps(nextProps) {
    const { calculator, overviewCalculator } = this;
    const { min, max, width, height, start } = nextProps;
    const { stackHeights, stackCollapsed } = this.state;

    let event = { name: 'size' };

    const contentHeights = this._getHeights(stackHeights, stackCollapsed, nextProps);

    if (
      this.props.width === width &&
      this.props.height === height
    ) {
      event = { name: 'data' };
    }

    this.setState({ ...contentHeights, event }, () => {
      calculator.update({
        width,
        start,
        min,
        max
      });

      overviewCalculator.update({
        width,
        start,
        min,
        max,
        offsetMinRatio: 0,
        offsetMaxRatio: 0
      });
    });
  }

  componentWillMount() {
    const { calculator, dragListener, overviewCalculator } = this;
    const { stackHeights, stackCollapsed } = this.state;

    const contentHeights = this._getHeights(stackHeights, stackCollapsed);

    calculator.on('change', this.__renderStackGrid);
    overviewCalculator.on('change', this.__renderOverviewGrid);

    dragListener.on('start', this.__handleDragStart);
    dragListener.on('drag', this.__handleDrag);

    this.setState({ ...contentHeights, event: { name: 'data' } });
  }

  render() {
    const { width, height, children, styles, overviewTimelineHeaderHeight, stackTimelineHeaderHeight } = this.props;
    const { stackHeights, stackViewportHeight, overviewViewportHeight, stackCollapsed, lastVisibleStackName, totalStackHeight } = this.state;
    const { overviewCalculator, calculator, dragListener } = this;

    let stackIdx = 0;
    let overviewCanvases = [];

    const stacks = React.Children.map(children, (child, i) => {
      let { name, collapsedHeight, overviewHeight } = child.props;

      collapsedHeight = collapsedHeight || 0;

      const isCollapsed = stackCollapsed[name];
      let stackHeight = isCollapsed ? collapsedHeight : stackHeights[name] * totalStackHeight;

      const overviewCanvas = {};

      if (overviewHeight > 0) {
        overviewCanvases.push(
          <Canvas key={i}
                  className='overviewCanvas'
                  width={width}
                  height={overviewHeight}
                  ref={ref => overviewCanvas.ref = ref ? ref : null}/>
        );
      }

      return React.cloneElement(child, {
        key: i,
        computedShowsOverview: overviewHeight > 0,
        computedHeight: stackHeight,
        computedCollapsed: isCollapsed,
        computedWidth: width,
        styles: child.props.styles || styles,
        setCollapsed: collapsed => this.setCollapsed(name, collapsed),
        overviewCalculator,
        calculator,
        overviewCanvas
      });
    });

    let firstPane = true;
    let splitPanes = [
      <div className='banner'></div>
    ];

    for (let i = stacks.length - 1; i >= -1; i--) {
      const stack = stacks[i];

      if (splitPanes.length === 2) {
        let topPane = splitPanes[1];
        let bottomPane = splitPanes[0];

        const { name } = topPane.props;

        if (topPane.props.computedCollapsed || lastVisibleStackName === name) {
          const { computedHeight } = topPane.props;

          splitPanes = [
            <SplitPane key={stackIdx++}
                       split='horizontal'
                       primary='first'
                       minSize={computedHeight}
                       maxSize={computedHeight}
                       size={computedHeight}
                       onChange={() => null}
                       resizerClassName='splitPaneResizer'
                       resizerStyle={{ pointerEvents: 'none' }}>
              {topPane}
              {bottomPane}
            </SplitPane>
          ];
        } else {
          const { computedHeight, name } = topPane.props;

          splitPanes = [
            <SplitPane key={stackIdx++}
                       split='horizontal'
                       primary='first'
                       minSize={0}
                       className={ firstPane ? 'Panel1Only' : null}
                       resizerClassName='splitPaneResizer'
                       resizerStyle={firstPane ? { pointerEvents: 'none', display: 'none !important' } : null}
                       onChange={size => this.setHeight(name, size)}
                       size={computedHeight}>
              {topPane}
              {bottomPane}
            </SplitPane>
          ];
        }

        firstPane = false;
      }

      if (stack != null) {
        splitPanes.push(stack);
      }
    }

    return (
      <StyleRoot>
        <Style scopeSelector='.banner'
               rules={styles.banner}/>
        <Style scopeSelector='.splitPaneResizer'
               rules={styles.splitPaneResizer}/>
        <Style scopeSelector='.splitPaneResizer:hover'
               rules={styles.splitPaneResizer_hover}/>
        <Style scopeSelector='.flameChart'
               rules={styles.flameChart}/>
        <Style scopeSelector='.flameChart'
               rules={styles.scrollBars}/>
        <Style scopeSelector='.stackWrapper'
               rules={styles.stackWrapper}/>
        <Style scopeSelector='.stackGridCanvas'
               rules={styles.stackGridCanvas}/>
        <Style scopeSelector='.overviewGridCanvas'
               rules={styles.overviewGridCanvas}/>
        <Style scopeSelector='.stacks'
               rules={styles.stacks}/>
        <Style scopeSelector='.overviewWrapper'
               rules={styles.overviewWrapper}/>
        <Style scopeSelector='.overviewCanvas'
               rules={styles.overviewCanvas}/>
        <Style scopeSelector='.SplitPane.Panel1Only.horizontal'
               rules={styles.splitPanePanel1Only}/>
        <div className='flameChart' style={{ width, height }}>
          <div className='overviewWrapper' style={{ width, height: overviewViewportHeight }}>
            <Canvas ref={ref => this.ref.overviewGrid = ref}
                    width={width}
                    height={overviewViewportHeight}
                    className='overviewGridCanvas'/>
            <div style={{ position: 'absolute', top: overviewTimelineHeaderHeight, left: 0 }}>
              {overviewCanvases}
            </div>
            <div style={{ position: 'absolute', top: 0, left: 0 }}>
              <Curtain height={overviewViewportHeight}
                       width={width}
                       styles={styles}
                       calculator={calculator}
                       onWheel={::this._handleWheel}/>
            </div>
          </div>
          <div className='stackWrapper'
               style={{ width, top: overviewViewportHeight }}
               {...dragListener.handlers}
               onWheel={::this._handleWheel}>
            <Canvas ref={ref => this.ref.grid = ref}
                    width={width}
                    autoScale={true}
                    height={stackViewportHeight}
                    className='stackGridCanvas'/>
            <div className='stacks'
                 style={{ top: stackTimelineHeaderHeight }}>
              {splitPanes}
            </div>
          </div>
        </div>
      </StyleRoot>
    )
  }
};
