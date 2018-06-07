import { renderSimpleFlameChart, unrenderSimpleFlameChart, injectSimpleFlameChartStyles } from '../src';
import * as HSLColorGenerator from '../src/helpers/HSLColorGenerator';

global.HSLColorGenerator = HSLColorGenerator;
global.renderSimpleFlameChart = renderSimpleFlameChart;
global.unrenderSimpleFlameChart = unrenderSimpleFlameChart;
global.injectSimpleFlameChartStyles = injectSimpleFlameChartStyles;