import React from 'react';

import BG0 from '../../assets/img/services/bg-0.jpg'
import BG1 from '../../assets/img/services/bg-1.jpg'
import BG2 from '../../assets/img/services/bg-2.jpg'
import BG3 from '../../assets/img/services/bg-3.jpg'
import BG4 from '../../assets/img/services/bg-4.jpg'
import BG5 from '../../assets/img/services/bg-5.jpg'


export default class Services extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      items: [
        {
          id: 0,
          bg: BG0,
          title: 'Business Consultation',
          name: 'Business',
          text: 'Apollo clutches Daphnes hip, pursuing her as she flees from him. Apollo wears a laurel crown, and Daphne is portrayed halfway through her metamorphosis from human form into the laurel tree, with her arms already transforming into its branches as she flees and calls to her father to save her from Apollo.',
        },
        {
          id: 1,
          bg: BG1,
          title: 'Investment',
          name: 'Investment',
          text: 'Apollo clutches Daphnes hip, pursuing her as she flees from him.',
        },
        {
          id: 2,
          bg: BG2,
          title: 'Anti-Crisis',
          name: 'Anti-Crisis',
          text: 'Apollo clutches Daphnes hip, pursuing her as she flees from him. Apollo wears a laurel crown, and Daphne is portrayed halfway through her metamorphosis from human form into the laurel tree, with her arms already transforming into its branches as she flees and calls to her father to save her from Apollo.',
        },
        {
          id: 3,
          bg: BG3,
          title: 'Marketing Research',
          name: 'Marketing',
          text: 'Apollo clutches Daphnes hip, pursuing her as she flees from him. Apollo wears a laurel crown, and Daphne is portrayed halfway through her metamorphosis from human form into the laurel tree, with her arms already transforming into its branches as she flees and calls to her father to save her from Apollo.',
        },
        {
          id: 4,
          bg: BG4,
          title: 'Startups',
          name: 'Startups',
          text: 'Apollo clutches Daphnes hip, pursuing her as she flees from him. Apollo wears a laurel crown, and Daphne is portrayed halfway through her metamorphosis from human form into the laurel tree, with her arms. Apollo clutches Daphnes hip, pursuing her as she flees from him. Apollo wears a laurel crown, and Daphne is portrayed halfway through her metamorphosis from human form into the laurel tree.',
        },
        {
          id: 5,
          bg: BG5,
          title: 'Legal Consultation',
          name: 'Consultation',
          text: 'Apollo clutches Daphnes hip, pursuing her as she flees from him. Apollo wears a laurel crown, and Daphne is portrayed halfway through her metamorphosis from human form into the laurel tree, with her arms already transforming into its branches as she flees and calls to her father to save her from Apollo.',
        },
      ]
    }
  }

  renderItem(item,i){
    return (
      <div className={`services_item ${this.props.observer ? 'observer_item' : ''}`} style={{backgroundImage: `url(${item.bg})`}} key={`services_item-${item.id}`}>
        <div className="services_item_content">
          <div className="services_item_top">
            <p className="services_item_title">{item.title}</p>
          </div>
          <div className="services_item_body">
            <p className="services_item_name">{item.name}</p>
            <p>{item.text}</p>
          </div>
        </div>
      </div>
    )
  }

  render(){
    return (
      <section className={`main-block services_block ${this.props.observer ? 'observer' : ''}`}>  
        <div className="center-main-block">
          <h2 className="services_title">Our Services</h2>
          <div className="services_box">
            {this.state.items.map((item,i) => this.renderItem(item,i))}
          </div>
        </div>
      </section>
    )    
  }
}