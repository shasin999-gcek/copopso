import React, { Component } from 'react';

import queryString from "query-string";
import Api from "../../Utils/api";

export default class ViewResult extends Component {
	constructor(props) {
		super(props);
		this.state = {
			loading: true,
			result: null
		}
	}

	componentDidMount() {
		const { location } = this.props;
		const query = queryString.parse(location.search);
		const { academic_year, semester } = query;

		Api.getResult(academic_year, semester)
			.then(response => {
				this.setState({result: response.data, loading:false});

				var canvas = document.getElementById('canvas').getContext("2d");

				// set default chart options
				Chart.defaults.global.defaultFontFamily = "Roboto";
				Chart.defaults.global.defaultFontSize = 12;
				Chart.defaults.global.defaultFontStyle = "bold";
				Chart.defaults.global.animation.easing = "easeOutCubic";

				var myChart = new Chart(canvas, {
			    type: 'bar',
			    data: {
			        labels: ["CE", "CSE", "ECE", "EEE", "ME"],
			        datasets: [{
			            label: '% of marks',
			            data: [
			            	this.state.result.CE,
			            	this.state.result.CSE,
			            	this.state.result.ECE,
			            	this.state.result.EEE,
			            	this.state.result.ME
			            ],
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)',
			                'rgba(75, 192, 192, 0.2)',
			                'rgba(153, 102, 255, 0.2)',
			            ],
			            borderColor: [
			                'rgba(255,99,132,1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			                'rgba(75, 192, 192, 1)',
			                'rgba(153, 102, 255, 1)',
			            ],
			            borderWidth: 2
			        }]
			    },
			    options: {
		        scales: {
	            yAxes: [{
                ticks: {
                    min: 0,
                    max: 100,
                    stepSize: 5
                }
	            }]
		        },
		        legend: { display: false },
			      title: {
			        display: true,
			        fontSize: 20,
			        fontFamily: "Quicksand",
			        text: `University Result ${academic_year} (Btech ${semester})`
			      }
			    }
				});
			});
		
	}

	render() {
		return (
			<div 
				className="chart-container" 
				style={{position: "relative", height:"70vh", width:"70vw"}}>
    		<canvas id="canvas"></canvas>
			</div>
		);
	}
}
