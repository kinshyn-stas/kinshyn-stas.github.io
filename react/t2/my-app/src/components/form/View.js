import React from 'react';

import Field from './Field';


export default class Form extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      name: '',
      phone: '',
      email: '',
      comment: '',

      errors: {},
      fields: [
        {
          name: 'name',
          type: 'text',
        },      
        {
          name: 'phone',
          type: 'phone',
        },
        {
          name: 'email',
          type: 'email',
        }
      ],
    }

    this.onChange = this.onChange.bind(this);
    this.onSubmit = this.onSubmit.bind(this);
  }

  onChange(e,name){
    if(name === 'phone'){
      if(!Number.isInteger(+e.nativeEvent.data)) return;
      if(e.nativeEvent.data === ' ') return;
    }

    let obj = {};
    obj[name] = e.target.value;

    let field;
    this.state.fields.forEach(f => {
      if(f.name === name) field = f;
    })

    this.setState(obj, () => {
      if(field) this.validateField(field)
    })
  }

  validateForm(callback){
    let errors = JSON.parse(JSON.stringify(this.state.errors));

    this.state.fields.forEach((field) => {
      this.validateField(field, errors)
    })

    this.setState({errors: errors}, callback)
  }

  validateField(field, errorsObj){
    let value = this.state[field.name];
    let error = false;

    switch (field.type){
      case 'phone':
        if(value.length !== 10 && value.length !== 12) error = true;
        break;
      case 'email':
        const r = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!r.test(String(value).toLowerCase())) error = true;
        break;
      case 'text':
        if(!value.length) error = true;
        break;
      default:
        if(!value.length) error = true;
        break;
    }


    if(errorsObj){
      if(error){
        errorsObj[field.name] = error;
      } else {
        delete errorsObj[field.name]
      }      
    } else {
      let errors = JSON.parse(JSON.stringify(this.state.errors));
      if(error){
        errors[field.name] = error;
      } else {
        delete errors[field.name]
      }      
      this.setState({errors: errors})
    }
  }

  onSubmit(e){
    this.validateForm(() => {
      let errorsFlag = true;

      for(let k in this.state.errors){
        errorsFlag = false;
      }

      if(errorsFlag) this.setState({plugShow: true})
    });
    e.preventDefault();
  }

  render(){
    return (
      <React.Fragment>
        {this.state.plugShow ? (
            <div className="form_plug">
              <h2 className="form_title">Thank you</h2>
              <p className="form_undertitle">Wait for feedback please</p>
              <p className="form_undertitle">(Ожидание затянется, потому что форма никуда не отправляется. Бэкенда нет.)</p>
            </div>
          ) : (
            <form className={`form ${this.props.observer ? 'observer' : ''}`} onSubmit={this.onSubmit} data-observerdirection="opacity">
              {this.props.title && <h2 className="form_title">{this.props.title}</h2>}
              <div className={`form_box ${this.props.observer ? 'observer_item' : ''}`}>
                <Field name='name' value={this.state.name} error={this.state.errors.name} placeholder='Name' onChange={this.onChange} required={true} />
                <Field type='tel' name='phone' value={this.state.phone} error={this.state.errors.phone} placeholder='Phone' onChange={this.onChange} required={true} maxlength="12" />
                <Field type='email' name='email' value={this.state.email} error={this.state.errors.email} placeholder='Email' onChange={this.onChange} required={true} />
                <Field name='comment' value={this.state.comment} error={this.state.errors.comment} placeholder='Comment' onChange={this.onChange} textarea={true} />
                <div className="form_item form_item-button">
                  <button className="form_button">Submit</button>
                </div>
              </div>
            </form>
          )
        }
      </React.Fragment>
    )    
  }
}