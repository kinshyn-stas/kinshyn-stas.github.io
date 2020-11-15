import React from 'react';
import ReactDOM from 'react-dom';

import BG0 from '../../assets/img/slider/bg-0.jpg'
import BG1 from '../../assets/img/slider/bg-1.jpg'
import BG2 from '../../assets/img/slider/bg-2.jpg'

export default class SliderMain extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      slides: [
        {
          bg: BG0,
          title: 'WALKING THE CITY',
          undertitle: 'Post-ironic authentic drinking vinegar chambray quinoa. VHS letterpress sriracha, tacos skateboard migas farm-to-table artisan kombucha.',
          linkHref: '/test1',
        },
        {
          bg: BG1,
          title: 'FLY THE CITY',
          undertitle: 'Post-ironic authentic drinking vinegar chambray quinoa. VHS letterpress sriracha, tacos skateboard migas farm-to-table artisan kombucha.',
          linkHref: '/test2',
        },
        {
          bg: BG2,
          title: 'SWIMMING THE CITY',
          undertitle: 'Post-ironic authentic drinking vinegar chambray quinoa. VHS letterpress sriracha, tacos skateboard migas farm-to-table artisan kombucha.',
          linkHref: '/test3',
          linkText: 'GO'
        },
      ],
      activeSlide: 0,
    }
  }

  renderSlide(item,i){
    return (
      <div className={`slider_item ${this.state.activeSlide == i ? 'active' : ''}`} style={{ backgroundImage: `url(${item.bg})` }} key={`slider_item-${i}`}>
        <div className="slider_item_content">
          {item.title && <h2 className="slider_item_title">{item.title}</h2>}
          {item.undertitle && <p className="slider_item_undertitle">{item.undertitle}</p>}
          {item.linkHref && <div className="slider_item_href">
            <a href={item.linkHref} className="slider_item_href_item">{item.linkText ? item.linkText : 'Read more'}</a>
          </div>}
        </div>
      </div>
    )
  }

  renderSliderNav(item,i){
    return (
      <button className={`slider_nav_item ${this.state.activeSlide == i ? 'active' : ''}`} onClick={(e) => this.changeSlide(i)} key={`slider_nav_item-${i}`}></button>
    )
  }

  changeSlide(b){
    let a = this.state.activeSlide;

    if(b instanceof Number){
      a = b;
    } else {      
      if(b){
        a++
        if(a >= this.state.slides.length) a = 0;
      } else {
        a--
        if(a < 0) a = this.state.slides.length - 1;
      }
    }

    this.setState({activeSlide: a})
  }

  render() {

    return (
      <div className="main-block slider_main">
        {this.state.slides.map((item,i) => this.renderSlide(item,i))}
        <div className="slider_arrow slider_arrow-left" onClick={() => this.changeSlide(false)}>
          <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.67 1.87L9.9 0.1L0 10L9.9 19.9L11.67 18.13L3.54 10L11.67 1.87Z" fill="#ffffff"/>
          </svg>
        </div>
        <div className="slider_arrow slider_arrow-right" onClick={() => this.changeSlide(true)}>
          <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M-1.90735e-06 1.87L1.77 0.1L11.67 10L1.77 19.9L-1.90735e-06 18.13L8.13 10L-1.90735e-06 1.87Z" fill="#ffffff"/>
          </svg>
        </div>
        <div className="slider_nav">{this.state.slides.map((item,i) => this.renderSliderNav(item,i))}</div>        
      </div>
    )    
  }
}