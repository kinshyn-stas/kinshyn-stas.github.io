import React from 'react';

import Info from './Info'

export default class Test extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      startClick: false,
      statistickClick: false,
      statistickKey: 0,

      mean: 0,
      standard: 0,
      fashion: 0,
      median: 0,
      lostQuotes: 0,

      timeStart: 0,
      timeStatistic: 0,
    }

    this.start = this.start.bind(this);
    this.getInfo = this.getInfo.bind(this);
  }

  start(){
    this.setState({startClick: true, timeStart: +new Date()})
  }

  getInfo(values){
    console.log('values',values)

    let number = 0;
    let sum = 0;

    let fashion = 0;
    let fashionNumbers = 0;

    for(let k in values){
      //console.log(k,values[k])
      sum = sum + (+k * values[k])
      number = number + values[k]

      if(values[k] > fashionNumbers){
        fashionNumbers = values[k]
        fashion = +k
      } else if(values[k] === fashionNumbers){
        fashion = [].concat(fashion, +k)
      }
    }

    let mean = parseInt(sum / number);

    let standard = 0;  
    let median = 0;
    let medianNumbers = 0;

    for(let k in values){
      standard = standard + (values[k] * Math.pow(((+k - mean) / (number - 1)), 2))

      medianNumbers = medianNumbers + values[k]
      if(!median && medianNumbers >= number / 2) median = +k
    }
    standard = Math.sqrt(standard)



    this.setState({mean: mean, standard: standard, fashion: fashion, median: median})
  }

  statistic(){
    this.setState({statistickClick: true, statistickKey: this.state.statistickKey + 1, timeStatistic: +new Date()})
  }

  render(){
    let time = this.state.timeStatistic - this.state.timeStart;
    time = parseInt(time / 1000)

    return (
      <div className="center-main-block">
        <button className="slider_item_href_item" onClick={() => this.start()}>Start</button>
        <br/>
        <button className="slider_item_href_item" onClick={() => this.statistic()}>Statistic</button>
        <br />
        <Info
          startClick={this.state.startClick}
          statistickKey={this.state.statistickKey}
          getInfo={this.getInfo}
        />
      </div>
    )    
  }
}