import React, { Component } from "react";
import CanvasJSReact from "../assets/js/canvasjs.stock.react";

var CanvasJSStockChart = CanvasJSReact.CanvasJSStockChart;

class HeartTempAxisStockChart extends Component {
    constructor(props) {
        super(props);
        this.state = { nisLoaded: false }
        this.dataPoints1 = [];
        this.dataPoints2 = [];
        this.dataPoints3 = [];
    }

    componentDidMount() {
        let dps1 = [],
            dps2 = [],
            dps3 = [],
            data = this.props.sensor
        for (var i = 0; i < data.length; i++) {
            dps1.push({
                x: new Date(data[i].date),
                y: Number(data[i].heart_rate),
            });
            dps2.push({
                x: new Date(data[i].date),
                y: Number(data[i].temp_sensor),
            });
            dps3.push({
                x: new Date(data[i].date),
                y: Number(data[i].heart_rate),
            });
        }
        this.setState({ isLoaded: true })
        this.dataPoints1 = dps1;
        this.dataPoints2 = dps2;
        this.dataPoints3 = dps3;
    }

    componentDidUpdate() {
        let dps1 = [],
            dps2 = [],
            dps3 = [],
            data = this.props.sensor
        for (var i = 0; i < data.length; i++) {
            dps1.push({
                x: new Date(data[i].date),
                y: Number(data[i].heart_rate),
            });
            dps2.push({
                x: new Date(data[i].date),
                y: Number(data[i].temp_sensor),
            });
            dps3.push({
                x: new Date(data[i].date),
                y: Number(data[i].heart_rate),
            });
        }
        this.dataPoints1 = dps1;
        this.dataPoints2 = dps2;
        this.dataPoints3 = dps3;
    }

    render() {
        const options = {
            theme: "light2",
            // title: { text: "React StockChart with Heart rate-Temp sensor Axis" },
            subtitles: [{ ntext: "Price-Volume Trend" }],
            charts: [
                {
                    axisX: {
                        lineThickness: 5,
                        tickLength: 0,
                        labelFormatter: function (e) {
                            return "";
                        },
                        crosshair: {
                            enabled: true,
                            snapToDataPoint: true,
                            labelFormatter: function (e) {
                                return "";
                            },
                        },
                    },
                    axisY: {
                        title: "Values Heart Rate",
                        prefix: "C ",
                        tickLength: 0,
                    },
                    toolTip: {
                        shared: true,
                    },
                    data: [
                        {
                            name: "Heart Rate",
                            type: "line",
                            xValueFormatString: "DD MMM - HH:mm",
                            yValueFormatString: "C#.###",
                            dataPoints: this.dataPoints1,
                        },
                    ],
                },
                {
                    axisX: {
                        crosshair: {
                            enabled: true,
                            snapToDataPoint: true,
                        },
                    },
                    axisY: {
                        title: "Values Temp Sensor",
                        prefix: "D ",
                        tickLength: 0,
                    },
                    toolTip: {
                        shared: true,
                    },
                    data: [
                        {
                            name: "Temp Sensor",
                            type: "line",
                            xValueFormatString: "DD MMM - HH:mm",
                            yValueFormatString: "D#.###",
                            dataPoints: this.dataPoints2,
                        },
                    ],
                },
            ],
            navigator: {
                data: [
                    {
                        type: "line",
                        dataPoints: this.dataPoints3,
                    },
                ],
            },
        };
        const containerProps = {
            width: "80vw",
            height: "450px",
            margin: "auto",
        };
        return (
            <div>
                <h3 className=" mb-6">React StockChart with Date-Time Axis</h3>
                {this.state.isLoaded && (
                    <CanvasJSStockChart
                        containerProps={containerProps}
                        options={options}
                        /* onRef = {ref => this.chart = ref} */
                    />
                )}
            </div>
        );
    }
}

export default HeartTempAxisStockChart;
