import React from 'react';

import BG0 from '../../assets/img/team/bg-0.jpg'
import BG1 from '../../assets/img/team/bg-1.jpg'
import BG2 from '../../assets/img/team/bg-2.jpg'
import BG3 from '../../assets/img/team/bg-3.jpg'
import BG4 from '../../assets/img/team/bg-4.jpg'
import BG5 from '../../assets/img/team/bg-5.jpg'
import BG6 from '../../assets/img/team/bg-6.jpg'
import BG7 from '../../assets/img/team/bg-7.jpg'
import BG8 from '../../assets/img/team/bg-8.jpg'


export default class TeamFull extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      items: [
        {
          id: 0,
          bg: BG0,
          title: 'Lucas Smith',
          position: 'Founder and CEO',
          text: 'Nunc eget felis ultricies ex egestas placerat. Nullam eu vulputate neque. Pellentesque lacinia arcu sed felis finibus pretium. Quisque venenatis leo quis leo fringilla mattis. Vivamus vehicula a justo sed pellentesque. Nullam sed ultrices metus.'
        },
        {
          id: 1,
          bg: BG1,
          title: 'Mark Crood',
          position: 'Managing Director',
          text: 'Nulla facilisi. Nam a auctor turpis, nec posuere augue. Suspendisse placerat volutpat quam sed pulvinar. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum et rutrum odio.',
        },
        {
          id: 2,
          bg: BG2,
          title: 'Santa Moritz',
          position: 'Developer',
          text: 'Fusce eget mattis urna. Suspendisse vitae lacus augue. Mauris in erat ut nisi eleifend fermentum eu eu sem. Sed convallis metus vel orci ultrices volutpat.'
        },
        {
          id: 3,
          bg: BG3,
          title: 'Lucas Bing',
          position: 'Director PR & Strategy',
          text: 'Praesent finibus mollis magna, eget sodales metus fermentum eu. Curabitur accumsan tellus nunc, eget dapibus lorem hendrerit vitae. Sed id pellentesque metus, vitae placerat velit. Integer fringilla porttitor orci, lacinia lacinia velit efficitur in. Ut blandit, nisl sed condimentum venenatis, lacus massa sagittis est, at facilisis dui turpis eu mauris.'
        },
        {
          id: 4,
          bg: BG4,
          title: 'John Silver',
          position: 'Dancer',
          text: 'Proin arcu erat, blandit a nisi sollicitudin, auctor vehicula nisl. Nam in tortor dignissim lacus aliquet pellentesque. Maecenas eget mi dictum, malesuada massa vitae, eleifend urna. Suspendisse nec turpis purus. Aliquam a imperdiet mauris. Sed aliquet ultrices tristique. Suspendisse in tortor tortor.'
        },
        {
          id: 5,
          bg: BG5,
          title: 'Michael Kann',
          position: 'Manager',
          text: 'Nullam iaculis egestas ultricies. Nunc mollis velit sit amet dapibus aliquet. Praesent nec eleifend dui, et facilisis odio. Nulla sit amet posuere lectus, ut auctor massa.'
        },
        {
          id: 6,
          bg: BG6,
          title: 'Sophie Placido',
          position: 'PR Manager',
          text: 'Proin ullamcorper dapibus ligula, eget efficitur orci blandit non. Curabitur vehicula, quam eget blandit eleifend, lorem sem vulputate est, ac consectetur odio lorem quis sapien. Etiam commodo mauris id metus faucibus congue. Vivamus gravida libero a ipsum volutpat, sed ultrices dolor pellentesque. Morbi ut erat in augue congue sodales.'
        },
        {
          id: 7,
          bg: BG7,
          title: 'Tomas Jefferson',
          position: 'Top Manager',
          text: 'Morbi mattis nisi nibh, at sagittis libero hendrerit sed. Vestibulum laoreet sed sem sit amet auctor. Sed gravida volutpat nisi ac mollis. Nulla lobortis ex magna, ac fringilla lectus sollicitudin in.'
        },
        {
          id: 8,
          bg: BG8,
          title: 'Nick Young',
          position: 'Good guy',
          text: 'Nam ultricies arcu ut ante venenatis, pharetra bibendum sem consequat. Suspendisse tempor interdum mi sed posuere. Mauris quam arcu, pretium nec turpis vel, commodo placerat ligula. Proin pulvinar turpis sit amet sapien scelerisque, et euismod ligula vulputate.'
        },
      ],
      activeItem: 0,
      contentAnimationName: 1,
    }
  }

  setItem(i){
    if(i === this.state.activeItem) return;
    let k = this.state.contentAnimationName + 1;
    this.setState({activeItem: i, contentAnimationName: 0}, () => {
      setTimeout(() => {
        this.setState({contentAnimationName: k})
      }, 0)
    })
  }

  renderItem(item,i){
    return (
      <div className={`team_face ${this.props.observer ? 'observer_item' : ''}`} style={{backgroundImage: `url(${item.bg})`}} key={`team_item-${item.id}`} onClick={() => this.setItem(i)}>
        <div className="team_face_wrapper">
          <div className="team_face_content">
            <figure>
              <img src={item.bg} alt={item.title} />
            </figure>
            <p className="team_face_title">{item.title}</p>
            <p className="team_face_undertitle">{item.position}</p>
            <p className="team_face_text">{item.text}</p>
          </div>
        </div>
      </div>
    )
  }

  render(){
    let p = this.state.items[this.state.activeItem];
    let an = `${this.state.contentAnimationName ? 'showOpacity' : ''}`;

    return (
      <section className={`main-block team_block ${this.props.observer ? 'observer' : ''}`} data-observerdirection="opacity">  
        <div className="center-main-block">
          <h2 className="team_title">OUR AWESOME TEAM</h2>
          <p className="team_undertitle">Meet our professionals and experts in business consulting services</p>
          <div className={`team_grid ${this.props.observer ? 'observer_item' : ''}`}>
            {this.state.items.map((item,i) => this.renderItem(item,i))}
            <div className="team_grid_info">
              <div className="team_grid_info_content" style={{animationName: an}}>
                <figure>
                  <img src={p.bg} alt={p.title} />
                </figure>
                <p className="team_grid_info_content_title">{p.title}</p>
                <p className="team_grid_info_content_undertitle">{p.position}</p>
                <p>{p.text}</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    )    
  }
}