import React from 'react';


export default class Field extends React.Component{
  constructor(props){
    super(props);
    this.state = {}
  }

  render(){
    return (
      <div className="form_item">
        {this.props.textarea ? (
            <textarea className={`form_input ${this.props.value ? 'form_input-fill' : ''} ${this.props.error ? 'invalid' : ''} ${this.props.required ? 'form_input-required' : ''}`} value={this.props.value} onChange={e => this.props.onChange(e,this.props.name)} />
          ) : (
            <input type={`${this.props.type ? this.props.type : 'text'}`} className={`form_input ${this.props.value ? 'form_input-fill' : ''} ${this.props.error ? 'invalid' : ''} ${this.props.required ? 'form_input-required' : ''}`} value={this.props.value} maxLength={`${this.props.maxlength ? this.props.maxlength : ''}`} onChange={e => this.props.onChange(e,this.props.name)} />
          )
        }
        <span className="form_input_placeholder">{this.props.placeholder}</span>
      </div>
    )    
  }
}