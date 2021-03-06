import React, { Component } from 'react'
import AppBar from 'material-ui/AppBar'
import './App.css'
import MainChart from './components/MainChart.jsx'
import DataConfigBar from './components/DataConfigBar.jsx'
import ChartConfigBar from './components/ChartConfigBar.jsx'
import Tooltip from './components/Tooltip.jsx'
import githubLogo from './github-logo.svg'
import ActionHome from 'material-ui/svg-icons/action/home'

const logoStyle = {
	marginTop: '10px',
	height: '25px'
}

class App extends Component {
	render() {
		return (
			<div className="App">
				<AppBar className="title-bar" title="React-Sample Data Generator"
			iconElementLeft={<a href="https://webmaster444.github.io/"><ActionHome color="white" style={logoStyle}/></a>}
			iconElementRight={<a href="https://github.com/webmaster444/webmaster444.github.io/react/data_generator_master/"><img src={githubLogo} style={logoStyle}/> </a>}/>
				<div className="content">
					<div className="primary-container">
						<ChartConfigBar/>
						<div className="main-chart-container">
							<MainChart/>
							<Tooltip/>
							<div className="instructions">Click anywhere on the chart to draw points. Right click on any point to remove it</div>
						</div>
					</div>
					<DataConfigBar/>
				</div>
			</div>
		)
	}
}

export default App
