import React from 'react';

import AboutImg from '../../assets/img/img_about.jpg'


export default class About extends React.Component{
  constructor(props){
    super(props);
    this.state = {}
  }

  render(){
    return (
      <section className={`main-block about_block ${this.props.observer ? 'observer' : ''}`} data-observerdirection="none">  
        <div className="center-main-block">
          <h2 className="about_title">About Us</h2>
          <div className={`about_content ${this.props.observer ? 'observer_item observer_item-opacity' : ''}`}>
            <div className={`about_content_text`}>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pellentesque lorem nec ex fermentum faucibus. Nunc bibendum dapibus sem sit amet gravida. Fusce diam lacus, porttitor ac congue quis, elementum ut urna. Etiam pulvinar quis tortor nec malesuada. Morbi ac nisl dui. Fusce iaculis elit bibendum faucibus hendrerit. Maecenas efficitur augue non tortor ullamcorper, non laoreet nunc cursus.</p>
              <p>Fusce efficitur risus in elit posuere fringilla. Maecenas lectus tortor, fermentum a laoreet et, efficitur nec leo. Fusce ante nisi, dictum eu pharetra a, lobortis ac ligula. Sed sed pellentesque quam. Mauris id iaculis elit, ut rutrum odio. Donec quis tincidunt sapien. Aliquam pulvinar mauris sit amet ullamcorper fringilla. Nulla eros dolor, venenatis sed orci a, condimentum commodo massa. Suspendisse potenti. Proin euismod nec ligula eget pellentesque. Phasellus mollis erat et sem fringilla dignissim. Quisque enim nibh, pharetra in volutpat at, efficitur a nunc.</p>
              <p>Ut in nunc eu mi elementum fringilla. In cursus sit amet ante in sollicitudin. Sed gravida vestibulum justo, nec feugiat magna malesuada ut. Fusce commodo orci sem, nec aliquam mauris rhoncus non. Praesent eleifend sem eu ultricies tincidunt. Phasellus suscipit, nunc in facilisis maximus, elit libero iaculis ex, a lobortis augue justo sed nulla. Etiam dignissim diam aliquam, ullamcorper nibh vel, laoreet nunc. Donec varius dolor ac odio tempor porta. Vivamus bibendum enim sed ante bibendum tempus. Cras eros mi, dignissim a dolor quis, volutpat hendrerit ligula. Aliquam in eros at magna pharetra auctor. Cras tincidunt fringilla risus at consequat. Cras pharetra velit quis consequat tempor. Ut pellentesque orci eu viverra eleifend. Proin non lacinia lacus.</p>
              <p>Vivamus scelerisque dolor auctor diam euismod, a ultrices eros mollis. Nunc sagittis id magna vitae laoreet. In egestas porta orci quis viverra. Nullam quis velit sit amet dolor fringilla condimentum et ac nisl. Vestibulum ornare viverra leo, in sodales nisl consequat nec. Sed et dignissim purus. Sed sed orci ut ipsum egestas interdum. Praesent ultricies ipsum at quam sollicitudin vehicula. Nunc semper blandit commodo.</p>
              <p>Quisque ex odio, gravida non lectus aliquet, tempus lacinia nulla. Etiam vitae nibh in mauris elementum facilisis nec a elit. Vestibulum dolor eros, mattis aliquet erat ut, rutrum mollis magna. Quisque consectetur, felis in pulvinar gravida, mauris purus volutpat enim, iaculis feugiat nunc purus ac magna. Nunc sit amet felis in quam venenatis congue. Maecenas magna velit, iaculis ac urna efficitur, ultrices iaculis est. Sed elementum bibendum mi non euismod.</p>
              <p>Sed libero dolor, ultricies ut hendrerit quis, fringilla vel est. Sed aliquet augue eu pulvinar dictum. Vestibulum facilisis sapien enim, vitae convallis mauris lobortis at. Donec tempus, elit non cursus rhoncus, mauris enim euismod turpis, sit amet eleifend felis arcu ac magna. Aenean non semper turpis. Proin non nisl lacinia, tincidunt est sit amet, pulvinar dolor. Ut bibendum leo eu nisi imperdiet luctus. Integer convallis felis nisl.</p>
            </div>
            <div className={`about_content_image ${this.props.observer ? 'observer_item observer_item-left' : ''}`}>
              <figure>
                <img src={AboutImg} alt="" />
              </figure>
            </div>
          </div>
        </div>
      </section>
    )    
  }
}