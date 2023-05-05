import React, { Component } from "react";
import CanvasJSReact from "../assets/js/canvasjs.stock.react";
var CanvasJSStockChart = CanvasJSReact.CanvasJSStockChart;

  //  api data like this 
var dataJson = [
  {
    date: "2018-01-01 5:00:00",
    heart_rate: 10,
    temp_sensor: 20.22,
  },
  {
    date: "2018-01-02 8:13:00",
    heart_rate: 20,
    temp_sensor: 30.36,
  },
  {
    date: "2018-01-03 9:35:00",
    heart_rate: 30,
    temp_sensor: 40.87,
  },
  {
    date: "2018-01-04 5:00:00",
    heart_rate: 40,
    temp_sensor: 50.22,
  },
  {
    date: "2018-01-05 8:13:00",
    heart_rate: 50,
    temp_sensor: 60.36,
  },
  {
    date: "2018-01-06 9:35:00",
    heart_rate: 60,
    temp_sensor: 70.87,
  },
  {
    date: "2018-01-07 5:00:00",
    heart_rate: 70,
    temp_sensor: 80.22,
  },
  {
    date: "2018-01-08 8:13:00",
    heart_rate: 80,
    temp_sensor: 90.36,
  },
  {
    date: "2018-01-09 9:35:00",
    heart_rate: 90,
    temp_sensor: 100.87,
  },
  {
    date: "2018-01-10 5:00:00",
    heart_rate: 10,
    temp_sensor: 20.22,
  },
  {
    date: "2018-01-11 8:13:00",
    heart_rate: 20,
    temp_sensor: 30.36,
  },
  {
    date: "2018-01-12 9:35:00",
    heart_rate: 30,
    temp_sensor: 40.87,
  },
];
class HeartTempAxisStockChart extends Component {
  constructor(props) {
    super(props);
    this.state = {
      dataPoints1: [],
      dataPoints2: [],
      dataPoints3: [],
      isLoaded: false,
    };
  }

  componentDidMount() {
    fetch("https://canvasjs.com/data/docs/ltcusd2018.json")
      .then((res) => res.json())
      .then((data) => {
        let dps1 = [],
          dps2 = [],
          dps3 = []
          // data = dataJson;
        for (var i = 0; i < data.length; i++) {
          dps1.push({
            x: new Date(data[i].date),
            y: Number(data[i].open),
          });
          dps2.push({
            x: new Date(data[i].date),
            y: Number(data[i].volume_usd),
          });
          dps3.push({
            x: new Date(data[i].date),
            y: Number(data[i].open),
          });
        }
        this.setState({
          isLoaded: true,
          dataPoints1: dps1,
          dataPoints2: dps2,
          dataPoints3: dps3,
        });
      });
  }

  render() {
    const options = {
      theme: "light2",
      // title: { text: "React StockChart with Heart rate-Temp sensor Axis" },
      subtitles: [{ ntext: "Price-Volume Trend" }],
      charts: [
        {
          axisX: {
            valueFormatString: "",
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
              type: "spline",
              xValueFormatString: "DD/MM/YYYY HH:mm",
              yValueFormatString: "C#.###",
              dataPoints: this.state.dataPoints1,
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
              type: "spline",
              xValueFormatString: "DD/MM/YYYY HH:mm",
              yValueFormatString: "D#.###",
              dataPoints: this.state.dataPoints2,
            },
          ],
        },
      ],
      navigator: {
        data: [
          {
            type: "splineArea",
            dataPoints: this.state.dataPoints3,
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
        {
          this.state.isLoaded && (
            <CanvasJSStockChart
              containerProps={containerProps}
              options={options}
              /* onRef = {ref => this.chart = ref} */
            />
          )
        }
      </div>
    );
  }
}

export default HeartTempAxisStockChart;
