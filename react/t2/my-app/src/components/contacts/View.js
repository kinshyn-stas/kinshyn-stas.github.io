import React from 'react';

import Form from '../form/View';


export default class Contacts extends React.Component{
  constructor(props){
    super(props);
    this.state = {}

  }

  render(){
    return (
      <section className={`main-block contacts_block`}>  
        <div className="center-main-block">
          <div className="contacts_content">
            <div className="contacts_left">

              <Form title="Contact us" observer={true} />

            </div>
            <div className={`contacts_right ${this.props.observer ? 'observer' : ''}`} data-observerdirection="left">

              <div className="contacts_info">

                <div className={`contacts_info_item ${this.props.observer ? 'observer_item' : ''}`}>
                  <p className="contacts_info_item_title">Location</p>
                  <p>1414 S. 13th St. Omaha, NE 68108</p>
                </div>

                <div className={`contacts_info_item ${this.props.observer ? 'observer_item' : ''}`}>
                  <p className="contacts_info_item_title">Opening Hours</p>
                  <p>7am-8pm Mon-Fri, 7am-6pm Sat and 9am-4pm Sun</p>
                </div>

                <div className={`contacts_info_item ${this.props.observer ? 'observer_item' : ''}`}>
                  <p className="contacts_info_item_title">Phones</p>
                  <p><a className="contacts_info_item_link contacts_info_item_link-phone" href="tel:380 96 41 25 412">+380 96 41 25 412</a></p>
                  <p><a className="contacts_info_item_link contacts_info_item_link-phone" href="tel:380 96 41 25 414">+380 96 41 25 414</a></p>
                  <p><a className="contacts_info_item_link contacts_info_item_link-phone" href="tel:380 96 41 25 416">+380 96 41 25 416</a></p>
                </div>

                <div className={`contacts_info_item ${this.props.observer ? 'observer_item' : ''}`}>
                  <p className="contacts_info_item_title">Email</p>
                  <p><a className="contacts_info_item_link contacts_info_item_link-email" href="mailto:example@mail.com">example@mail.com</a></p>
                </div>

              </div>

            </div>
          </div>
        </div>
      </section>
    )    
  }
}