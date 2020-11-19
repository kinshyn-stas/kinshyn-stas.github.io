import React from 'react';
import ReactDOM from 'react-dom';


export default class Services extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      items: [
        {
          title: 'FREE BASIC',
          price: '0',
          duration: 'Per Month',
          list: ['1 business consultation', 'general business plan', 'books recommendations', 'free video lecture record'],
          link: ''
        },
        {
          title: 'BASIC',
          price: '5',
          duration: 'Per Month',
          list: ['3 business consultations', 'basic business plan', 'access to the library', '3 video lecture records'],
          link: ''
        },
        {
          title: 'STANDART',
          price: '20',
          duration: 'Per Month',
          list: ['5 business consultations', 'standard business plan', 'access to the library', '5 video lecture records'],
          link: '',
          recommended: true,
        },
        {
          title: 'PREMIUM',
          price: '500',
          duration: 'Per Year',
          list: ['10 business consultations', 'individual business plan', 'access to the library', 'access to the Youtube videos'],
          link: ''
        },
      ]
    }
  }

  renderItem(item,i){
    return (
      <div className={`prices_item ${item.recommended ? 'recommended' : ''}`} key={`prices_item-${i}`}>
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
          <a href={item.link} className="prices_item_button">READ MORE</a>
        </div>
      </div>
    )
  }

  render(){
    return (
      <div className="main-block prices_block">  
        <div className="center-main-block">
          <h2 className="prices_title">OUR PRICE PLANS</h2>
          <div className="prices_box">
            {this.state.items.map((item,i) => this.renderItem(item,i))}
          </div>
        </div>
      </div>
    )    
  }
}