import React from 'react';

export default class Item extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      number: 0,
      finishNumber: this.props.item.number,
      flag: false,
    }

    this.item = React.createRef();
    this.checkItemPosition = this.checkItemPosition.bind(this);
  }

  componentDidMount(){
    this.checkItemPosition();
    document.addEventListener('scroll', this.checkItemPosition);
  }

  checkItemPosition(){
    if(!this.item.current){
      document.removeEventListener('scroll', this.checkItemPosition);
      return;
    }

    let pos = this.item.current.getBoundingClientRect();
    if(pos.top < (window.screen.height * 3 / 4) && pos.bottom > (window.screen.height * 1 / 4)){
      this.changeNumber();
    }
  }

  changeNumber(){
    if(this.state.flag) return;
    this.setState({flag: true});

    let s = this.state.finishNumber - 400;
    if(s<0) s = 0;
    this.setState({number: s});
    let t = parseInt((this.props.animTime + (this.props.i * 500)) / (this.state.finishNumber - s));
    
    document.removeEventListener('scroll', this.checkItemPosition);

    setTimeout(function f(){
      let n = this.state.number + 1;
      if(n >= this.state.finishNumber){
        n = this.state.finishNumber
        this.setState({number: n})
      } else {
        this.setState({number: n})
        setTimeout(f.bind(this), t)
      }
    }.bind(this), t)   
  }

  render() {
    return (
      <div className={`achiev_item ${this.state.flag ? 'active' : ''}`} ref={this.item}>
        <figure>
          {this.props.item.img}
        </figure>
        <p className="achiev_item_number">{this.state.number}</p>
        <p className="achiev_item_label">{this.props.item.label}</p>
      </div>
    )    
  }
}