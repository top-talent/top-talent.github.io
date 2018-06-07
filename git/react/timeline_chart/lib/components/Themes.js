'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.Dark = exports.Light = exports.Base = undefined;

var _merge2 = require('lodash/merge');

var _merge3 = _interopRequireDefault(_merge2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Base = exports.Base = {
  splitPaneResizer: {
    background: 'transparent',
    opacity: '.2',
    zIndex: '1',
    boxSizing: 'border-box',
    backgroundClip: 'padding-box',
    height: '11px',
    margin: '-5px 0',
    borderTop: '5px solid transparent',
    borderBottom: '5px solid transparent',
    cursor: 'row-resize',
    width: '100%'
  },
  tooltip: {
    boxShadow: '0 1px 3px rgba(0,0,0,0.3)',
    borderRadius: 2,
    padding: '3px 4px',
    color: 'transparent',
    background: 'transparent',
    whitespace: 'nowrap'
  },
  curtains: {
    position: 'relative'
  },
  curtainLeft: {
    left: 0,
    top: 0,
    position: 'absolute',
    height: '100%',
    borderRight: '1px solid transparent'
  },
  curtainRight: {
    right: 0,
    top: 0,
    position: 'absolute',
    height: '100%',
    borderLeft: '1px solid transparent'
  },
  curtainLeftThumb: {
    position: 'absolute',
    height: 20,
    width: 6,
    border: "1px solid transparent",
    right: -3,
    top: 0
  },
  curtainRightThumb: {
    position: 'absolute',
    height: 20,
    width: 6,
    border: "1px solid transparent",
    left: -3,
    top: 0
  },
  splitPaneResizer_hover: {
    transition: 'all 2s ease'
  },
  splitPanePanel1Only: {
    '> .Pane1': {
      height: '100% !important'
    },
    '> .Pane2': {
      height: '0 !important'
    }
  },
  flameChart: {
    position: 'relative',
    overflow: 'hidden'
  },
  stackWrapper: {
    bottom: 0,
    position: 'absolute',
    overflow: 'hidden'
  },
  stacks: {
    position: 'absolute',
    left: 0,
    right: 0,
    bottom: 0
  },
  stackGridCanvas: {
    position: 'absolute',
    left: 0,
    top: 0
  },
  overviewGridCanvas: {},
  stackGrid: {
    gridStrokeStyle: 'transparent',
    gridLineWidth: 1,
    headerBackgroundFillStyle: 'transparent',
    headerTextFillStyle: 'transparent',
    headerFont: '11px Lucida Grande\', \'Open Sans\', sans-serif'
  },
  overviewGrid: {
    gridStrokeStyle: 'transparent',
    gridLineWidth: 1,
    headerBackgroundFillStyle: 'transparent',
    headerTextFillStyle: 'transparent',
    headerFont: '11px Lucida Grande\', \'Open Sans\', sans-serif'
  },
  stackSearch: {
    width: 100,
    border: 'none',
    background: 'transparent',
    outline: 'none',
    display: 'inline-block',
    verticalAlign: 'top',
    position: 'relative',
    marginLeft: 2,
    cursor: 'default',
    height: 15,
    fontSize: '11px',
    fontStyle: 'italic',
    fontFamily: '\'Lucida Grande\', \'Open Sans\', sans-serif'
  },
  stackCanvas: { position: 'absolute', top: 0 },
  overviewWrapper: { borderBottom: '1px solid transparent' },
  overviewCanvas: { borderTop: '1px solid transparent' },
  stackScroller: {
    height: '100%',
    right: 0,
    width: 15,
    top: 0,
    position: 'absolute',
    overflow: 'hidden',
    overflowY: 'scroll'
  },
  stackTitleGroup: {
    display: 'inline-block',
    verticalAlign: 'top'
  },
  stackHeader: {
    position: 'absolute',
    top: '2px',
    left: '2px',
    padding: '0 4px',
    height: '15px',
    fontFamily: '\'Lucida Grande\', \'Open Sans\', sans-serif',
    lineHeight: '15px',
    cursor: 'pointer',
    userSelect: 'none'
  },
  stackSearchResultCount: {
    fontFamily: '\'Lucida Grande\', \'Open Sans\', sans-serif',
    lineHeight: '15px',
    fontSize: 9,
    fontStyle: 'italic',
    display: 'inline-block',
    paddingLeft: 4
  },
  stackTitle: {
    fontFamily: '\'Lucida Grande\', \'Open Sans\', sans-serif',
    fontSize: '11px',
    lineHeight: '15px',
    display: 'inline-block',
    verticalAlign: 'top'
  },
  stackArrow: {
    fontSize: '7px',
    height: '15px',
    fontFamily: '\'Lucida Grande\', \'Open Sans\', sans-serif',
    display: 'inline-block',
    lineHeight: '16px',
    marginRight: '3px',
    verticalAlign: 'top'
  },
  stackEntry: {
    font: '11px \'Lucida Grande\', \'Open Sans\', sans-serif',
    height: 17,
    textPadding: 4,
    textBaseline: 4
  },
  stackEntrySearchBackDrop: {},
  stackEntrySearchMatch: {},
  banner: {
    color: 'transparent',
    backgroundColor: 'transparent',
    display: 'flex',
    justifyContent: 'center',
    alignItems: 'center',
    textAlign: 'center',
    padding: '20px',
    position: 'absolute',
    top: 0,
    right: 0,
    bottom: 0,
    left: 0,
    fontSize: '13px',
    overflow: 'auto',
    boxSizing: 'border-box'
  },
  scrollBars: {
    '*::-webkit-scrollbar': {
      width: '10px',
      height: '10px',
      borderRadius: '100px'
    },
    '*::-webkit-scrollbar:hover': {
      borderRadius: 0
    },
    '*::-webkit-scrollbar-thumb:vertical': {
      borderRadius: '100px',
      backgroundClip: 'padding-box',
      border: '2px solid transparent',
      minHeight: '10px'
    },
    '*::-webkit-scrollbar-thumb:vertical:active': {
      backgroundClip: 'padding-box',
      border: '2px solid transparent',
      borderRadius: '100px'
    },
    '*::-webkit-scrollbar-thumb:horizontal': {
      borderRadius: '100px',
      backgroundClip: 'padding-box',
      border: '2px solid transparent',
      minWidth: '10px'
    },
    '*::-webkit-scrollbar-thumb:horizontal:active': {
      backgroundClip: 'padding-box',
      border: '2px solid transparent',
      borderRadius: '100px'
    }
  }
};

var Light = exports.Light = (0, _merge3.default)({}, Base, {
  splitPaneResizer: {
    backgroundColor: 'rgba(0, 0, 0, 0.5)',
    borderTopColor: 'rgba(255, 255, 255, 0)',
    borderBottomColor: 'rgba(255, 255, 255, 0)',
    cursor: 'row-resize',
    width: '100%'
  },
  splitPaneResizer_hover: {
    transition: 'all 2s ease',
    borderTopColor: 'rgba(0, 0, 0, 0.5)',
    borderBottomColor: 'rgba(0, 0, 0, 0.5)'
  },
  tooltip: {
    color: '#333',
    background: '#FFF'
  },
  flameChart: {
    backgroundColor: '#FFF'
  },
  stackWrapper: {
    backgroundColor: '#FFF'
  },
  stackGrid: {
    gridStrokeStyle: 'rgba(0, 0, 0, 0.1)',
    headerBackgroundFillStyle: 'rgba(255, 255, 255, 0.5)',
    headerTextFillStyle: '#333'
  },
  overviewGrid: {
    gridStrokeStyle: 'rgba(0, 0, 0, 0.1)',
    headerBackgroundFillStyle: 'rgba(255, 255, 255, 0.5)',
    headerTextFillStyle: '#333'
  },
  stackSearchResultCount: {
    color: 'rgba(0, 0, 0, 0.4)'
  },
  overviewWrapper: { borderBottomColor: '#CCC' },
  overviewCanvas: { borderTopColor: '#EEE' },
  stackSearch: {
    color: '#333'
  },
  stackHeader: {
    backgroundColor: 'rgba(255, 255, 255, 0.7)'
  },
  stackTitle: {
    color: '#333'
  },
  stackArrow: {
    color: '#333'
  },
  stackEntry: {
    strokeStyle: '#FFF',
    textFillStyle: '#333'
  },
  stackEntryHighlighted: {
    backdropFillStyle: 'hsla(231, 48%, 48%, 0.2)',
    fillStyle: 'hsla(231, 48%, 48%, 0.3)',
    strokeStyle: 'hsl(231, 48%, 48%)',
    textFillStyle: 'hsl(231, 48%, 48%)'
  },
  stackEntrySelected: {
    backdropFillStyle: 'rgba(180, 50, 0, 0.2)',
    fillStyle: 'rgba(180, 50, 0, 0.3)',
    strokeStyle: 'rgb(180, 50, 0)',
    textFillStyle: 'rgb(180, 50, 0)'
  },
  banner: {
    color: '#777',
    backgroundColor: 'white'
  },
  curtainLeft: {
    background: 'hsla(0, 0%, 80%, 0.5)',
    borderRightColor: 'hsla(0, 0%, 70%, 0.5)'
  },
  curtainRight: {
    background: 'hsla(0, 0%, 80%, 0.5)',
    borderLeftColor: 'hsla(0, 0%, 70%, 0.5)'
  },
  curtainLeftThumb: {
    borderColor: "#FFF",
    background: "rgb(153, 153, 153)"
  },
  curtainRightThumb: {
    borderColor: "#FFF",
    background: "rgb(153, 153, 153)"
  },
  scrollBars: {
    '*::-webkit-scrollbar': {
      backgroundColor: 'rgba(0, 0, 0, 0)'
    },
    '*::-webkit-scrollbar:hover': {
      backgroundColor: 'rgba(0, 0, 0, 0.09)'
    },
    '*::-webkit-scrollbar-thumb:vertical': {
      backgroundColor: 'rgba(0, 0, 0, 0.5)',
      borderColor: 'rgba(0, 0, 0, 0)',
      minHeight: '10px'
    },
    '*::-webkit-scrollbar-thumb:vertical:active': {
      backgroundColor: 'rgba(0, 0, 0, 0.61)',
      borderColor: 'rgba(0, 0, 0, 0)'
    },
    '*::-webkit-scrollbar-thumb:horizontal': {
      backgroundColor: 'rgba(0, 0, 0, 0.5)',
      borderColor: 'rgba(0, 0, 0, 0)'
    },
    '*::-webkit-scrollbar-thumb:horizontal:active': {
      backgroundColor: 'rgba(0, 0, 0, 0.61)',
      borderColor: 'rgba(0, 0, 0, 0)'
    }
  }
});

var Dark = exports.Dark = (0, _merge3.default)({}, Base, {
  splitPaneResizer: {
    backgroundColor: 'rgba(255, 255, 255, 0.5)',
    borderTopColor: 'rgba(0, 0, 0, 0)',
    borderBottomColor: 'rgba(0, 0, 0, 0)',
    cursor: 'row-resize',
    width: '100%'
  },
  splitPaneResizer_hover: {
    transition: 'all 2s ease',
    borderTopColor: 'rgba(255, 255, 255, 0.5)',
    borderBottomColor: 'rgba(255, 255, 255, 0.5)'
  },
  tooltip: {
    color: '#ccc',
    background: '#333'
  },
  curtainLeft: {
    background: 'hsla(0, 0%, 24%, 0.5)',
    borderRightColor: 'hsla(0, 0%, 30%, 0.5)'
  },
  curtainRight: {
    background: 'hsla(0, 0%, 24%, 0.5)',
    borderLeftColor: 'hsla(0, 0%, 30%, 0.5)'
  },
  curtainLeftThumb: {
    borderColor: "rgb(36, 36, 36)",
    background: "rgb(102, 102, 102)"
  },
  curtainRightThumb: {
    borderColor: "rgb(36, 36, 36)",
    background: "rgb(102, 102, 102)"
  },
  flameChart: {
    backgroundColor: '#222'
  },
  stackWrapper: {
    backgroundColor: '#222'
  },
  stackGrid: {
    gridStrokeStyle: 'rgba(255, 255, 255, 0.1)',
    headerBackgroundFillStyle: 'rgba(0, 0, 0, 0.0)',
    headerTextFillStyle: '#AAA'
  },
  overviewGrid: {
    gridStrokeStyle: 'rgba(255, 255, 255, 0.1)',
    headerBackgroundFillStyle: 'rgba(0, 0, 0, 0.0)',
    headerTextFillStyle: '#AAA'
  },
  overviewWrapper: { borderBottomColor: '#555' },
  overviewCanvas: { borderTopColor: '#444' },
  stackSearch: {
    color: '#AAA'
  },
  stackHeader: {
    backgroundColor: 'rgba(0, 0, 0, 0.3)',
    ' > div:hover': {
      backgroundColor: 'rgba(0, 0, 0, 1)'
    }
  },
  stackTitle: {
    color: '#AAA'
  },
  stackArrow: {
    color: '#AAA'
  },
  stackEntry: {
    strokeStyle: '#222',
    textFillStyle: '#000'
  },
  stackEntryHighlighted: {
    backdropFillStyle: 'rgba(255, 0, 0, 0.2)',
    fillStyle: 'rgba(0, 255, 0, 0.3)',
    strokeStyle: 'rgb(0, 255, 0)',
    textFillStyle: 'rgb(0, 255, 0)'
  },
  stackEntrySelected: {
    backdropFillStyle: 'rgba(0, 0, 255, 0.2)',
    fillStyle: 'rgba(255, 0, 0, 0.3)',
    strokeStyle: 'rgb(255, 0, 0)',
    textFillStyle: 'rgb(255, 0, 0)'
  },
  banner: {
    color: '#777',
    backgroundColor: '#222'
  },
  scrollBars: {
    '*::-webkit-scrollbar': {
      backgroundColor: 'rgba(255, 255, 255, 0)'
    },
    '*::-webkit-scrollbar:hover': {
      backgroundColor: 'rgba(255, 255, 255, 0.09)'
    },
    '*::-webkit-scrollbar-thumb:vertical': {
      backgroundColor: 'rgba(255, 255, 255, 0.5)',
      borderColor: 'rgba(255, 255, 255, 0)',
      minHeight: '10px'
    },
    '*::-webkit-scrollbar-thumb:vertical:active': {
      backgroundColor: 'rgba(255, 255, 255, 0.61)',
      borderColor: 'rgba(255, 255, 255, 0)'
    },
    '*::-webkit-scrollbar-thumb:horizontal': {
      backgroundColor: 'rgba(255, 255, 255, 0.5)',
      borderColor: 'rgba(255, 255, 255, 0)'
    },
    '*::-webkit-scrollbar-thumb:horizontal:active': {
      backgroundColor: 'rgba(255, 255, 255, 0.61)',
      borderColor: 'rgba(255, 255, 255, 0)'
    }
  }
});

exports.default = Light;
