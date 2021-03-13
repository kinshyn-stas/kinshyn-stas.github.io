import React from 'react';


export default class Seo extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      text: `Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut nibh dignissim, tincidunt urna ut, vehicula mi. Pellentesque congue ante eu arcu elementum ornare. Aenean fermentum arcu a massa imperdiet tincidunt. Nullam gravida urna nec fermentum sagittis. Vivamus eget diam mi. Sed et ornare metus. Praesent eu accumsan leo. Etiam pulvinar mauris eget nunc tempus egestas. Duis rhoncus lectus justo, quis rutrum nulla interdum a. Sed dui augue, vehicula ut ullamcorper at, bibendum sed ligula. Morbi fermentum libero sit amet felis lobortis, eu lobortis nisi luctus. Aliquam feugiat venenatis magna ac accumsan.

      Mauris lacinia et turpis non tempus. Quisque ac ultricies justo. Ut in nisl vitae libero bibendum posuere vitae non orci. Cras luctus ligula risus. Sed finibus nunc vel mauris pretium ultricies. Morbi ut gravida sapien, quis mattis elit. Phasellus libero tellus, gravida eu nisi at, finibus aliquam risus. Aenean a sapien porta, fringilla erat eu, ultricies lacus. Phasellus odio nulla, ultricies sed elit id, convallis volutpat mauris. Aenean egestas vehicula euismod.

      Fusce blandit risus non orci tempor eleifend. Aenean a dictum urna. Nullam tortor leo, luctus sit amet lectus id, luctus commodo neque. Maecenas eget fringilla libero. Curabitur id enim cursus, luctus erat sit amet, porttitor ex. Duis cursus imperdiet cursus. Suspendisse aliquet est vitae feugiat porttitor. Phasellus ultrices, velit malesuada tincidunt lobortis, nisi metus facilisis metus, sit amet lacinia augue est eget ante. Duis tempor massa vestibulum elit pulvinar tincidunt. Duis elementum mauris nisl, sit amet interdum nisi efficitur ut. Pellentesque pellentesque auctor interdum.

      Maecenas semper eros pharetra lorem blandit suscipit. Quisque et venenatis ipsum. Mauris luctus felis elit, pellentesque congue ex fermentum sed. Nam porttitor nulla arcu, quis elementum odio placerat in. Vestibulum non volutpat diam, sed porttitor magna. Quisque faucibus lacus augue, eu rutrum neque malesuada eget. Mauris sed congue nisi, eget dignissim felis. Sed bibendum elit quis purus sagittis, ut gravida justo auctor. Aliquam nec eleifend ex. Morbi imperdiet tincidunt dui, sit amet fermentum nisl tempus in. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;

      Quisque sodales vitae justo sit amet condimentum. Nullam ut tortor at risus venenatis vestibulum sed efficitur felis. Suspendisse id consequat lacus. Donec quis feugiat eros, a sodales tortor. Fusce augue urna, varius a pharetra nec, facilisis sit amet felis. Maecenas ante lacus, posuere non consectetur gravida, pulvinar vitae dolor. Pellentesque id sem vel neque sollicitudin tristique id nec quam. Morbi odio turpis, elementum vitae turpis posuere, dictum ultrices augue. Integer malesuada velit ac ex sodales, non porttitor odio pellentesque. Pellentesque dui augue, convallis ut sagittis ac, rhoncus et nulla. Sed pellentesque risus justo, eget efficitur metus ullamcorper sit amet. Quisque dignissim placerat diam eget aliquet. Pellentesque tortor nulla, molestie id turpis vel, vulputate bibendum magna. Pellentesque mattis nulla at purus placerat, a venenatis mauris tincidunt.`
    }
  }

  render(){
    return (
      <section className={`main-block seo_block ${this.props.observer ? 'observer' : ''}`} data-observerdirection="opacity">  
        <div className="center-main-block">
          <h2 className="seo_title">SEO text</h2>
          <div className={`seo_content ${this.props.observer ? 'observer_item' : ''}`}>
            {this.state.text}
          </div>
        </div>
      </section>
    )    
  }
}