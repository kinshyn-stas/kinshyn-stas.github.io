import React from 'react';

export default class Info extends React.Component{
  constructor(props){
    super(props);
    this.state = {
    }

    this.handlerMessage = this.handlerMessage.bind(this);
  }

  componentDidUpdate(prevProps,prevState){
    if(prevProps.startClick !== this.props.startClick && this.props.startClick){
      this.startInfo();
    }

    if(prevProps.statistickKey !== this.props.statistickKey && this.props.startClick){
      //let test = {1: 1, 9: 20, 2: 1, 6: 2, 7: 1, 8: 2, 3: 1, 4: 1, 5: 1}
      //this.props.getInfo(test);
      this.props.getInfo(this.state);
    }
  }

  startInfo(){    
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

    let v = JSON.parse(event.data).value;
    let res = this.state[`${v}`];
    if(v || v === 0){
      if(res){
        res = res + 1
      } else {
        res = 1
      }        
    }

    //console.log(values)
    let obj = {};
    obj[`${v}`] = res;
    this.setState(obj)    
  }

  statistic(){
    this.setState({statistickClick: true, timeStatistic: +new Date()})
  }

  render(){
    let time = this.state.timeStatistic - this.state.timeStart;
    time = parseInt(time / 1000)

    return (
      <div className="center-main-block">
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