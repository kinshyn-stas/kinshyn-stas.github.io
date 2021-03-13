import React from 'react';

import Face0 from '../../assets/img/testimonials/face-0.jpg'
import Face1 from '../../assets/img/testimonials/face-1.jpg'
import Face2 from '../../assets/img/testimonials/face-2.jpg'
import Face3 from '../../assets/img/testimonials/face-3.jpg'
import Face4 from '../../assets/img/testimonials/face-4.jpg'
import Face5 from '../../assets/img/testimonials/face-5.jpg'
import Face6 from '../../assets/img/testimonials/face-6.jpg'
import Face7 from '../../assets/img/testimonials/face-7.jpg'


export default class Testimonials extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      items: [
        {
          id: 0,
          img: Face0,
          title: 'Lucas Smith',
          undertitle: 'SEO Microsoft',
          text: 'We love the Casper original! In fact, this is our second Casper mattress. We purchased the first one for our Airbnb. Our reviews frequently comment on the comfort of the bed, and we found ourselves… If you have any questions related to Signavio’s tools, then Johannes is your man. He’s been coaching and training our customers since he joined the team in January 2015, and you’ll never catch him without a smile on his face. A strong believer in patience, listening and the saying “Practice makes perfect,” Johannes is a passionate piano player who taught himself his entire repertoire by ear.'
        },
        {
          id: 1,
          img: Face1,
          title: 'Johannes Oreiro',
          undertitle: 'Team Lead Training DACH',
          text: 'We love the Casper original! In fact, this is our second Casper mattress.'
        },
        {
          id: 2,
          img: Face2,
          title: 'John Useless',
          undertitle: 'Agile Coach',
          text: 'Our reviews frequently comment on the comfort of the bed, and we found ourselves…'
        },
        {
          id: 3,
          img: Face3,
          title: 'Sascha Pencil',
          undertitle: 'Software Developer',
          text: 'We love the Casper original! In fact, this is our second Casper mattress. We purchased the first one for our Airbnb.'
        },
        {
          id: 4,
          img: Face4,
          title: 'Bashar Asad',
          undertitle: 'Web Developer',
          text: 'If you have any questions related to Signavio’s tools, then Johannes is your man. He’s been coaching and training our customers since he joined the team in January 2015, and you’ll never catch him without a smile on his face. A strong believer in patience, listening and the saying “Practice makes perfect,” Johannes is a passionate piano player who taught himself his entire repertoire by ear. unboxing was easier than it looked. Best sleep for me ever....not too firm, not too soft. easy on my soon to be replaced shoulder. I no longer thrash about at night to get comfortable'
        },
        {
          id: 5,
          img: Face5,
          title: 'Daniel Storm',
          undertitle: 'IT Helpdesk Engineer',
          text: 'unboxing was easier than it looked. Best sleep for me ever....not too firm, not too soft. easy on my soon to be replaced shoulder. If you have any questions related to Signavio’s tools, then Johannes is your man. He’s been coaching and training our customers since he joined the team in January 2015, and you’ll never catch him without a smile on his face. A strong believer in patience, listening and the saying “Practice makes perfect,” Johannes is a passionate piano player who taught himself his entire repertoire by ear.'
        },
        {
          id: 6,
          img: Face6,
          title: 'Niamh Smith',
          undertitle: 'Content Specialist',
          text: 'I no longer thrash about at night to get comfortable'
        },
        {
          id: 7,
          img: Face7,
          title: 'Holly Berry',
          undertitle: 'UX Designer Apple',
          text: 'Elevated our Airbnb, then we just had to have our own'
        },
      ],
      columns: 3,
    }
  }

  componentDidMount(){
    this.sortItems(this.state.items);
  }

  sortItems(arr){
    let a = JSON.parse(JSON.stringify(arr))

    a.sort((a,b) => {
      if(!a.text || !b.text) return 0;
      if(a.text.length > b.text.length) return -1;
      if(a.text.length < b.text.length) return 1;
      return 0;
    })

    a.forEach((p,i) => {
      let n = parseInt(i / 8) * 3;

      if(i % 8 === 0){
        p.column = '1 / 2';
        p.row = `${n + 1} / ${n + 3}`;
      } else if(i % 8 === 1){
        p.column = `${this.state.columns} / ${this.state.columns + 1}`;
        p.row = `${n + 2} / ${n + 4}`;
      } else if(i % 8 === 2){
        p.column = `1 / ${this.state.columns + 1}`;
        p.row = `${n + 4} / ${n + 5}`;
      }
    })

    this.setState({items: a})
  }

  renderItem(item,i){
    return (
      <div className={`tst_item ${this.props.observer ? 'observer_item' : ''}`} key={`tst_item-${item.id}`} style={{gridRow: item.row, gridColumn: item.column}}>
        <div className="tst_head">
          <figure>
            <img src={item.img} alt={item.title} />
          </figure>
          <h4 className="tst_item_title">{item.title}</h4>
          <p className="tst_item_undertitle">{item.undertitle}</p>
        </div>
        <div className="tst_body">
          <p>{item.text}</p>
        </div>
      </div>
    )
  }

  render(){
    return (
      <section className={`main-block tst_block ${this.props.observer ? 'observer' : ''}`} data-observerrandom="true">  
        <div className="center-main-block">
          <h2 className="tst_title">Testimonials</h2>
          <div className="tst_box">
            {this.state.items.map((item,i) => this.renderItem(item,i))}
          </div>
        </div>
      </section>
    )    
  }
}