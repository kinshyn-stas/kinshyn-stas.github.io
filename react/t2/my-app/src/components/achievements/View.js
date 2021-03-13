import React from 'react';

import Item from './Item'

export default class Achievements extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      items: [
        {
          number: 1250,
          label: 'HOURS OF WORK',
          img: <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M11.99 2C6.47 2 2 6.48 2 12C2 17.52 6.47 22 11.99 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 11.99 2ZM12 20C7.58 20 4 16.42 4 12C4 7.58 7.58 4 12 4C16.42 4 20 7.58 20 12C20 16.42 16.42 20 12 20Z" fill="#ffffff"/>
          <path d="M12.5 7H11V13L16.25 16.15L17 14.92L12.5 12.25V7Z" fill="#ffffff"/>
          </svg>,
        },
        {
          number: 340,
          label: 'FINISHED WORKS',
          img: <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM9 17H7V10H9V17ZM13 17H11V7H13V17ZM17 17H15V13H17V17Z" fill="#ffffff"/>
          </svg>,
        },
        {
          number: 95,
          label: 'CLIENTS',
          img: <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M19 3H14.82C14.4 1.84 13.3 1 12 1C10.7 1 9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM12 3C12.55 3 13 3.45 13 4C13 4.55 12.55 5 12 5C11.45 5 11 4.55 11 4C11 3.45 11.45 3 12 3ZM12 7C13.66 7 15 8.34 15 10C15 11.66 13.66 13 12 13C10.34 13 9 11.66 9 10C9 8.34 10.34 7 12 7ZM18 19H6V17.6C6 15.6 10 14.5 12 14.5C14 14.5 18 15.6 18 17.6V19Z" fill="#ffffff"/>
          </svg>,
        },
      ],

      animTime: 3000,
    }
  }

  render(){
    return (
      <div className="main-block achiev_block">  
        <div className="center-main-block">
          <h2 className="achiev_title">AGENCY ACHIEVEMENTS</h2>
          <div className="achiev_box">
            {this.state.items.map((item,i) => <Item item={item} i={i} animTime={this.state.animTime} key={`achiev_item-${i}`} />)}
          </div>
        </div>
      </div>
    )    
  }
}