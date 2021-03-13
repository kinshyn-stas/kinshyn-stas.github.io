import React from 'react';

import BG0 from '../../assets/img/team/bg-0.jpg'
import BG1 from '../../assets/img/team/bg-1.jpg'
import BG2 from '../../assets/img/team/bg-2.jpg'
import BG3 from '../../assets/img/team/bg-3.jpg'


export default class Team extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      items: [
        {
          id: 0,
          bg: BG0,
          title: 'Lucas Smith',
          text: 'Non-standard approaches and the most complicated'
        },
        {
          id: 1,
          bg: BG1,
          title: 'Mark Crood',
          text: 'Non-standard approaches and the most complicated'
        },
        {
          id: 2,
          bg: BG2,
          title: 'Santa Moritz',
          text: 'Only cutting edge technology'
        },
        {
          id: 3,
          bg: BG3,
          title: 'Lucas Bing',
          text: 'Frontend is my passion. Every pixel'
        },
      ]
    }
  }

  renderItem(item,i){
    return (
      <div className={`team_item ${this.props.observer ? 'observer_item' : ''}`} style={{backgroundImage: `url(${item.bg})`}} key={`team_item-${item.id}`}>
        <div className="team_item_wrapper">
          <div className="team_item_content">
            <p className="team_item_title">{item.title}</p>
            <p>{item.text}</p>
          </div>
        </div>
      </div>
    )
  }

  render(){
    return (
      <section className={`main-block team_block ${this.props.observer ? 'observer' : ''}`} data-observerdirection="right">  
        <div className="center-main-block">
          <h2 className="team_title">OUR AWESOME TEAM</h2>
          <p className="team_undertitle">Meet our professionals and experts in business consulting services</p>
          <div className="team_box">
            {this.state.items.map((item,i) => this.renderItem(item,i))}
          </div>
        </div>
      </section>
    )    
  }
}