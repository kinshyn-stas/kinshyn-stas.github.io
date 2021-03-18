import React from 'react';

import Info from './Info'

export default class Statistic extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      startClick: false,
      statistickClick: false,
      statistickKey: 0,

      MN: 0,
      SD: 0,
      FS: 0,
      MD: 0,
      LQ: 0,

      timeStart: 0,
      timeStatistic: 0,
    }

    this.start = this.start.bind(this);
    this.getInfo = this.getInfo.bind(this);
  }

  start(){
    if(this.state.startClick) return;
    this.setState({startClick: true, timeStart: +new Date()})
  }

  getInfo(values){
    let LQ = values.lost;

    let number = 0;
    let sum = 0;

    let FS = 0;
    let FSNumbers = 0;

    for(let k in values){
      if(k !== 'lost'){
        sum = sum + (+k * values[k])
        number = number + values[k]

        if(values[k] > FSNumbers){
          FSNumbers = values[k]
          FS = +k
        } else if(values[k] === FSNumbers){
          FS = [].concat(FS, +k)
        }        
      }
    }

    let MN = parseInt(sum / number);

    let SD = 0;  
    let MD = 0;
    let MDNumbers = 0;

    for(let k in values){
      if(k !== 'lost'){
        SD = SD + (values[k] * Math.pow(((+k - MN) / (number - 1)), 2))

        MDNumbers = MDNumbers + values[k]
        if(!MD && MDNumbers >= number / 2) MD = +k        
      }
    }
    SD = Math.sqrt(SD)



    this.setState({MN: MN, SD: SD, FS: FS, MD: MD, LQ: LQ})
  }

  statistic(){
    this.setState({statistickClick: true, statistickKey: this.state.statistickKey + 1, timeStatistic: +new Date()})
  }

  render(){
    let time = this.state.timeStatistic - this.state.timeStart;
    let sec = parseInt(time / 1000);
    let min = 0;
    let hours = 0;
    if(sec >= 60){
      min = parseInt(sec / 60);
      sec = sec - min * 60
    }
    if(min >= 60){
      hours = parseInt(min / 60);
      min = min - hours * 60
    }
    time = `${hours ? hours + 'h ' : ''}${min ? min + 'm ' : ''}${sec}s`


    let FSstroke = '';
    if(this.state.FS.length){
      this.state.FS.forEach((n,i) => {
        FSstroke += `${i ? ', ' : ''}${n}`
      })      
    } else {
      FSstroke = this.state.FS;
    } 

    return (
      <div className="main-block">
        <div className="buttons">
          <button onClick={() => this.start()}>Старт</button>
          <button onClick={() => this.statistic()}>Статистика</button>
        </div>
        <Info
          startClick={this.state.startClick}
          statistickKey={this.state.statistickKey}
          getInfo={this.getInfo}
        />
        
        {this.state.statistickClick && (
          <div className="info">
            <p><b>Время расчетов:</b> {time}</p>
            {!!this.state.LQ && <p><b>Количество потерянных котировок:</b> {this.state.LQ}</p>}
            <p><b>Среднее значение:</b> {this.state.MN}</p>
            <p><b>Стандартное отклонение:</b> {this.state.SD}</p>
            <p><b>Медиана:</b> {this.state.MD}</p>
            <p><b>Мода:</b> {FSstroke}</p>
          </div>
        )}
      </div>
    )    
  }
}