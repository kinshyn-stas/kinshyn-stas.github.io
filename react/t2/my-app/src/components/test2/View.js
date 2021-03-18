import React from 'react';

export default class Test2 extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      ip: '142.250.185.174',
    }
  }

  start(){
    let url = `http://${this.state.ip}`;

    /*new Promise((resolve, reject) => {
      fetch(`${url}`, {
        method: "GET",
        referrer: "",

      })
        .then(response => {
          console.log('url', url)
          console.log('response', response)
          return
        })
        .catch(err => reject(err))
    })*/

    let xhr = new XMLHttpRequest();
    xhr.open('GET', url)
    xhr.send()

    xhr.onload = function() {
      console.log(`Загружено: ${xhr.status} ${xhr.response}`);
    };

    xhr.onerror = function() { // происходит, только когда запрос совсем не получилось выполнить
      console.log(`Ошибка соединения`);
    };

    xhr.onprogress = function(event) { // запускается периодически
      // event.loaded - количество загруженных байт
      // event.lengthComputable = равно true, если сервер присылает заголовок Content-Length
      // event.total - количество байт всего (только если lengthComputable равно true)
      console.log(`Загружено ${event.loaded} из ${event.total}`);
    };
  }

  render(){

    return (
      <div className="center-main-block">
        <input value={this.state.ip} onChange={(e) => this.setState({ip: e.target.value})} />
        <button className="slider_item_href_item" onClick={() => this.start()}>Start</button>
      </div>
    )    
  }
}