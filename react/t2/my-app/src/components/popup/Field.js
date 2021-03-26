import React from 'react';


export default class Field extends React.Component{
  constructor(props){
    super(props);
    this.state = {}
  }

  render(){
    return (
      <div className="form_item">
        <input className={`form_input ${this.props.value ? 'form_input-fill' : ''} ${this.props.error ? 'invalid' : ''} form_input-required`} value={this.props.value} onChange={e => this.props.onChange(e,name)} />
        <span className="form_input_placeholder">{this.props.placeholder}</span>
      </div>
    )    
  }
}