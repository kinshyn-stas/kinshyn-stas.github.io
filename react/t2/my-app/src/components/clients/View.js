import React from 'react';

import Logo0 from '../../assets/img/clients/logo-0.png'
import Logo1 from '../../assets/img/clients/logo-1.png'
import Logo2 from '../../assets/img/clients/logo-2.png'
import Logo3 from '../../assets/img/clients/logo-3.png'
import Logo4 from '../../assets/img/clients/logo-4.png'
import Logo5 from '../../assets/img/clients/logo-5.png'
import Logo6 from '../../assets/img/clients/logo-6.png'
import Logo7 from '../../assets/img/clients/logo-7.png'


export default class Services extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      items: [
        {
          id: 0,
          img: Logo0,
          alt: '1+1',
        },
        {
          id: 1,
          img: Logo1,
          alt: 'Nokia',
        },
        {
          id: 2,
          img: Logo2,
          alt: 'Adidas',
        },
        {
          id: 3,
          img: Logo3,
          alt: 'Oriflame',
        },
        {
          id: 4,
          img: Logo4,
          alt: 'Shell',
        },
        {
          id: 5,
          img: Logo5,
          alt: 'ACC',
        },
        {
          id: 6,
          img: Logo6,
          alt: 'Ukrkomos',
        },
        {
          id: 7,
          img: Logo7,
          alt: 'Gillette',
        },
      ]
    }
  }

  renderItem(item,i){
    return (
      <div className={`clients_item ${this.props.observer ? 'observer_item' : ''}`} key={`clients_item-${item.id}`}>
        <figure>
          <img src={item.img} alt={item.alt ? item.alt : ''} />
        </figure>
      </div>
    )
  }

  render(){
    return (
      <section className={`main-block clients_block ${this.props.observer ? 'observer' : ''}`}>  
        <div className="center-main-block">
          <h2 className="clients_title">Our Clients</h2>
          <div className="clients_box">
            {this.state.items.map((item,i) => this.renderItem(item,i))}
          </div>
        </div>
      </section>
    )    
  }
}