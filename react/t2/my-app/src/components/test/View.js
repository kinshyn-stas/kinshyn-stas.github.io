import React from 'react';

export default class Test extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      startClick: false,
      statistickClick: false,

      values: {},

      mean: 0,
      standard: 0,
      fashion: 0,
      median: 0,
      lostQuotes: 0,

      timeStart: 0,
      timeStatistic: 0,
    }

    this.handlerMessage = this.handlerMessage.bind(this);
  }

  /*componentDidUpdate(prevProps,prevState){
    console.log(prevState.values,this.state.values)
  }*/

  start(){
    this.setState({startClick: true, timeStart: +new Date()})
    let socket = new WebSocket("wss://trade.trademux.net:8800/?password=1234");

    socket.onopen = function(e) {
      console.log("[open] Соединение установлено");
      console.log("Отправляем данные на сервер");
      socket.send("Меня зовут Джон");
    };

    socket.onmessage = (event) => this.handlerMessage(event);

    socket.onclose = function(event) {
      if (event.wasClean) {
        console.log(`[close] Соединение закрыто чисто, код=${event.code} причина=${event.reason}`);
      } else {
        // например, сервер убил процесс или сеть недоступна
        // обычно в этом случае event.code 1006
        console.log('[close] Соединение прервано');
      }
    };

    socket.onerror = function(error) {
      console.log(`[error] ${error.message}`);
    };
  }

  handlerMessage(event){
    //console.log(`[message] Данные получены с сервера: ${event.data}`);
    let values = JSON.parse(JSON.stringify(this.state.values));

    let v = JSON.parse(event.data).value;
    if(v || v === 0){
      if(values[`${v}`]){
        values[`${v}`] = values[`${v}`] + 1
      } else {
        values[`${v}`] = 1
      }        
    }
    console.log(v,values[v])

    //console.log(values)
    this.setState({values: values})    
  }

  statistic(){
    this.setState({statistickClick: true, timeStatistic: +new Date()})
  }

  render(){
    let time = this.state.timeStatistic - this.state.timeStart;
    time = parseInt(time / 1000)

    return (
      <div className="center-main-block">
        <button onClick={() => this.start()}>Start</button>
        <br/>
        <button onClick={() => this.statistic()}>Statistic</button>
        <br />
        {this.state.statistickClick && (
          <div>
            <p><b>среднее:</b> {this.state.mean}</p>
            <p><b>стандартное отклонение:</b> {this.state.standard}</p>
            <p><b>моду:</b> {this.state.fashion}</p>
            <p><b>медиану:</b> {this.state.median}</p>
            <p><b>время расчетов:</b> {time}s</p>
            <p><b>количество потерянных котировок :</b> {this.state.lostQuotes}</p>
          </div>
        )}
      </div>
    )    
  }
}