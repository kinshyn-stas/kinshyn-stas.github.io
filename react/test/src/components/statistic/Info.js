import React from 'react';

export default class Info extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      lost: 0,
    }

    this.handlerMessage = this.handlerMessage.bind(this);
  }

  componentDidUpdate(prevProps,prevState){
    if(prevProps.startClick !== this.props.startClick && this.props.startClick){
      this.startInfo();
    }

    if(prevProps.statistickKey !== this.props.statistickKey && this.props.startClick){
      this.props.getInfo(this.state);
    }
  }

  startInfo(){    
    let socket = new WebSocket("wss://trade.trademux.net:8800/?password=1234");

    socket.onopen = function(e) {
      console.log("Соединение установлено");
    };

    socket.onmessage = (event) => this.handlerMessage(event);

    socket.onclose = function(event) {
      if (event.wasClean) {
        console.log(`Соединение закрыто чисто, код=${event.code} причина=${event.reason}`);
      } else {
        console.log('Соединение прервано');
        this.startInfo();
      }
    };

    socket.onerror = function(error) {
      console.log(`Error ${error.message}`);
    };
  }

  handlerMessage(event){
    let v = JSON.parse(event.data).value;
    let res;
    if(v || v === 0){
      res = this.state[`${v}`];        
    } else {
      res = 'lost';
    }

    res = res ? res + 1 : 1;

    let obj = {};
    obj[`${v}`] = res;
    this.setState(obj)    
  }

  render(){
    return (
      <div></div>
    )    
  }
}