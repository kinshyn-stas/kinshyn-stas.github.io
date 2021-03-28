import React from 'react';

import Popup from '../popup/View';
import Form from '../form/View';


export default class Services extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      items: [
        {
          id: 0,
          title: 'FREE BASIC',
          price: '0',
          duration: 'Per Month',
          list: ['1 business consultation', 'general business plan', 'books recommendations', 'free video lecture record'],
        },
        {
          id: 1,
          title: 'BASIC',
          price: '5',
          duration: 'Per Month',
          list: ['3 business consultations', 'basic business plan', 'access to the library', '3 video lecture records'],
        },
        {
          id: 2,
          title: 'STANDART',
          price: '20',
          duration: 'Per Month',
          list: ['5 business consultations', 'standard business plan', 'access to the library', '5 video lecture records'],
          recommended: true,
        },
        {
          id: 3,
          title: 'PREMIUM',
          price: '500',
          duration: 'Per Year',
          list: ['10 business consultations', 'individual business plan', 'access to the library', 'access to the Youtube videos'],
        },
      ],
      popupShow: false,
    }
  }

  renderItem(item,i){
    return (
      <div className={`prices_item ${this.props.observer ? 'observer_item' : ''} ${item.recommended ? 'recommended' : ''}`} key={`prices_item-${item.id}`}>
        <div className="prices_item_top">
          <p>{item.title}</p>
        </div>
        <div className="prices_item_price">
          <p className="prices_item_price_number">${item.price}</p>
          <p className="prices_item_price_duration">{item.duration}</p>
        </div>
        <div className="prices_item_body">
          <ul className="prices_item_list">
            {item.list.map((t,n) => {
              return <li className="prices_item_list_item" key={`prices_item_list_item-${n}`}>{t}</li>
            })}
          </ul>
        </div>
        <div className="prices_item_bottom">
          <a className="prices_item_button" onClick={() => this.setState({popupShow: true})}>TAKE</a>
        </div>
      </div>
    )
  }

  render(){
    return (
      <React.Fragment>
        <section className={`main-block prices_block ${this.props.observer ? 'observer' : ''}`} data-observerdirection="right">  
          <div className="center-main-block">
            <h2 className="prices_title">OUR PRICE PLANS</h2>
            <div className="prices_box">
              {this.state.items.map((item,i) => this.renderItem(item,i))}
            </div>
          </div>
        </section>
        
        {this.state.popupShow && (
          <Popup close={() => this.setState({popupShow: false})}>
            <Form />
          </Popup>
        )}
      </React.Fragment>
    )    
  }
}