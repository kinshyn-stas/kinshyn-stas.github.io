import React from 'react';


export default class Map extends React.Component{
  constructor(props){
    super(props);
    this.state = {}

  }

  render(){
    return (
      <section className={`main-block map_block ${this.props.observer ? 'observer' : ''}`} data-observerdirection="opacity">  
        <iframe className={`${this.props.observer ? 'observer_item' : ''}`} src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3888.5611990398656!2d30.51045066975808!3d50.46547835015586!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce6aeb46254f%3A0x8e70cf5f182d1883!2z0JrQvtC90YLRgNCw0LrRgtC-0LLQsNGPINC_0LvQvtGJ0LDQtNGM!5e0!3m2!1sru!2sua!4v1616785195552!5m2!1sru!2sua" allowFullScreen="" loading="lazy"></iframe>
      </section>
    )    
  }
}