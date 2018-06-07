import React from 'react';
import ReactDOM from 'react-dom';

export default class TooltipWrapper extends React.Component {
  state = { content: null, top: 0, left: 0, visible: false };
  ref = {};

  setContent(content) {
    this.setState({ content });
  }

  setVisible(visible) {
    if (visible !== this.state.visible) {
      this.setState({ visible });
    }
  }

  setPosition(left, top) {
    this.setState({ top, left });
  }

  _updatePosition() {
    const { root } = this.ref;
    const { width, height } = this.props;

    let { top, left } = this.state;

    if (root != null) {
      if (left + root.offsetWidth > width) {
        left = width - root.offsetWidth - 15;
      }

      if (top + root.offsetHeight > height) {
        top = height - root.offsetHeight - 3;
      }

      root.style.transform = `translate(${left}px, ${top}px)`;
    }
  }

  componentDidUpdate() {
    this._updatePosition();
  }

  componentDidMount() {
    this._updatePosition();
  }

  render() {
    const { top, left, content, visible } = this.state;

    if (!visible) {
      return null;
    }

    return (
      <div ref={ref => this.ref.root = ReactDOM.findDOMNode(ref)}
           style={{ position: 'absolute', zIndex: 100, top: 0, left: 0, pointerEvents: 'none' }}>
        {content}
      </div>
    )
  }
}