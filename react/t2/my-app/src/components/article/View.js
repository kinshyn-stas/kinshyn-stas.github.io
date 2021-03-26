import React from 'react';
import { withRouter, Link } from "react-router-dom";

import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {newsTag} from '../../store/actions.js';

import Preloader from '../preloader/View'

import Img0 from '../../assets/img/news/news-0.jpg'
import Img1 from '../../assets/img/news/news-1.jpg'


class Article extends React.Component{
  constructor(props){
    super(props);
    this.state = {}
  }

  render(){
    let article = this.props.articleInfo
    if(!article) return null;

    return (
      <section className={`main-block article_block ${this.props.observer ? 'observer' : ''}`} data-observerdirection="opacity">  
        <div className="center-main-block">
          <Link to={'/news'} className="return_link"><span>back</span></Link>
          <h2 className="article_title">{article.title}</h2>
          <div className="article_panel">
            <time className="article_panel_time"><b>Posted:</b> {article.date}</time>
            {!!article.tags.length && (
              <div className="article_panel_tags">
              {article.tags.map(tag => {
                return <Link to={`/news`} className="article_panel_tags_item" onClick={() => this.props.changeTag({newsTag: tag})} key={`article_panel_tags_item-${tag}`}>#{tag}</Link>
              })}
              </div>
            )}             
          </div>
          <div className="article_content observer_item">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum finibus nibh. Etiam blandit tellus eget mollis ultricies. Nullam dapibus, justo sed elementum rutrum, tortor dolor egestas dolor, id imperdiet nunc lacus vitae enim. Vivamus posuere tincidunt metus vitae dictum. Ut rutrum felis nec nisl semper vestibulum. Cras ac lorem vitae sapien tempus lacinia. Sed nisi neque, scelerisque et ipsum quis, placerat viverra turpis. Aliquam erat volutpat. Pellentesque luctus, tortor eu mattis rhoncus, sapien ante tempus nulla, at scelerisque lectus diam ut sapien. Maecenas a turpis ornare, cursus ipsum quis, sollicitudin ligula. Nulla iaculis dapibus tempor.</p>
            <p>Donec gravida lacus ut augue tempor posuere eget eu justo. Duis nec consectetur odio. Fusce id finibus sapien. Ut nisi turpis, euismod id suscipit a, porta vitae velit. Integer pellentesque est et libero efficitur dignissim. Maecenas at turpis ac est ultrices rutrum. Aliquam eu interdum orci. Pellentesque mi purus, varius et semper in, vestibulum ut dui.</p>
            <p>Cras consequat blandit ornare. Curabitur sodales magna eget ultrices maximus. Aliquam erat volutpat. Fusce imperdiet pharetra nisi vel lacinia. Fusce bibendum nisi at dui auctor, vel fringilla magna scelerisque. Nullam interdum justo vehicula, pulvinar est sed, condimentum nulla. Nullam sollicitudin sem quis viverra iaculis. Morbi posuere sodales ligula quis aliquet. Etiam cursus vel mi egestas bibendum. Nunc eget leo ut erat elementum dignissim. Curabitur vehicula pretium molestie. Mauris ac dui volutpat, commodo justo ut, finibus sapien. Phasellus vel gravida mi. Donec sollicitudin egestas massa, in tincidunt ligula maximus sit amet. Vivamus blandit vulputate blandit. Donec blandit risus est, eu elementum ipsum ullamcorper sit amet.</p>
            <img src={Img0} alt="" />
            <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris efficitur quis eros ut venenatis. Donec vel turpis odio. In euismod suscipit malesuada. Etiam laoreet, justo eget porta ultrices, leo nibh aliquet nunc, non finibus enim libero ac ipsum. Quisque imperdiet tempor commodo. Duis et lacus tristique, aliquet libero eu, congue diam. Proin volutpat pretium suscipit. Integer id magna eros. Vivamus eget quam vel lorem tincidunt fermentum eleifend eget ex.</p>
            <p>Vestibulum tempor ultrices tincidunt. Curabitur risus dui, vestibulum quis orci vel, consequat ullamcorper quam. Curabitur vel efficitur erat. Quisque lacinia elit non velit rhoncus pharetra sed ac tortor. In pellentesque vestibulum bibendum. Nulla tincidunt tincidunt volutpat. Nunc sit amet metus libero. Suspendisse potenti. Aliquam ac congue orci.</p>
            <p>Maecenas viverra vestibulum tellus quis cursus. Etiam sodales cursus est, vitae sodales nisl maximus a. Donec scelerisque, augue a pharetra egestas, mi ex tempus ipsum, in tempus est elit et magna. Nulla convallis lectus ultricies tincidunt viverra. Pellentesque et mattis ex. Pellentesque ut risus ultrices, commodo ligula vel, cursus lacus. Donec aliquam ut purus ac dapibus.</p>
            <p>Praesent lectus purus, dictum vitae interdum sed, auctor quis sem. Nullam molestie id leo at pretium. Quisque sagittis tincidunt dapibus. Phasellus a nulla at purus tempus auctor sed non purus. Fusce felis ligula, efficitur at congue in, sollicitudin tincidunt ligula. Fusce faucibus eros justo, eu ultricies lacus convallis vel. Cras a erat in lacus suscipit scelerisque id quis lectus. Ut sed justo sit amet leo accumsan mollis ut ac est. Etiam eget metus nunc. Nunc posuere ultrices risus. Nullam consectetur condimentum magna quis placerat. Suspendisse a libero massa.</p>
            <img src={Img1} alt="" />
            <p>Fusce vel fringilla tortor, vitae ullamcorper est. In fringilla vel lorem eu sollicitudin. Suspendisse a ullamcorper mi. In sit amet congue risus. Donec non finibus enim, in tristique nibh. Pellentesque dapibus eget elit eget vulputate. Phasellus sed libero suscipit elit placerat ultricies. Aliquam iaculis tempus mauris, et ornare ipsum varius ut. Nunc ac est quis purus efficitur malesuada nec eu magna. Aliquam id quam at risus pharetra imperdiet. Sed sagittis magna et facilisis vestibulum. Suspendisse pharetra lorem at interdum vehicula.</p>
            <p>Sed vitae convallis tellus. Nullam sit amet nisi sit amet felis ullamcorper gravida. Nulla facilisi. Aliquam quis auctor diam. Curabitur suscipit libero et pretium sagittis. Quisque nec egestas leo, non ornare magna. Aliquam sapien massa, congue aliquam ex eu, varius suscipit ex. Mauris ultricies, ipsum a aliquet tincidunt, est lacus rutrum metus, vitae eleifend ante dolor eget nisi. Integer a arcu ipsum.</p>
            <p>Cras tincidunt suscipit sem sit amet luctus. Nulla elementum consectetur dui eget placerat. Nunc enim purus, pellentesque eu lacus vitae, laoreet aliquet nulla. Proin sed tincidunt elit. Nullam finibus nibh et magna consequat ornare. Phasellus vitae odio nec ipsum eleifend tincidunt. Fusce dapibus nunc non ante eleifend blandit. Vestibulum maximus dolor ac feugiat lobortis. Curabitur in urna in nisl ultricies semper non vel libero. Praesent sit amet leo vel ex cursus mollis ut id sapien. Nullam fringilla, eros eu rutrum ornare, urna justo ultrices neque, eget convallis turpis magna in ligula. Aenean venenatis nisl lacus. Donec mollis nibh at aliquam maximus. Suspendisse quam est, porta eu varius eget, commodo elementum odio.</p>
            <p>Nunc rutrum luctus erat, vitae vehicula ligula hendrerit eu. Praesent sodales elit a felis aliquam volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eu odio velit. Praesent tincidunt, mauris sit amet congue cursus, ipsum tellus mattis massa, a vestibulum neque ligula sagittis velit. Curabitur diam odio, ullamcorper ut auctor in, porttitor vel odio. Phasellus at mi vel nulla convallis finibus vel nec felis. Etiam pellentesque ac velit vitae ultricies. Curabitur laoreet porta ex. Etiam dignissim quis odio eget aliquam. Donec id accumsan odio, non gravida sem. Praesent faucibus felis at nisl consequat tempor. Etiam pellentesque mi sit amet finibus interdum.</p>
            <p>Donec aliquet justo risus, at feugiat lacus varius a. Quisque commodo scelerisque quam, at dignissim enim efficitur a. Duis ac justo vitae felis auctor feugiat non sed magna. Nunc blandit mauris ac nisi pulvinar laoreet. Cras velit purus, facilisis ut nunc blandit, dignissim vulputate sem. Quisque dictum auctor consectetur. In euismod sem ac eros scelerisque, vel auctor dolor mollis. Donec mauris justo, bibendum sit amet hendrerit ut, auctor eu massa.</p>
            <p>Curabitur posuere dictum tellus, in molestie justo eleifend ullamcorper. Sed ullamcorper venenatis justo, eget faucibus metus porta ut. Nulla rutrum orci at varius sollicitudin. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus id scelerisque sem, nec facilisis justo. Aenean lacus lacus, tincidunt vitae tristique mollis, ultricies ut turpis. Aliquam rhoncus ipsum dolor, ac aliquam nibh molestie ac. Nunc felis erat, iaculis non mollis quis, facilisis nec nisi. Proin gravida tellus a rhoncus fermentum. Duis ac feugiat dolor. Donec aliquet sapien nec turpis auctor facilisis.</p>
          </div>
        </div>
      </section>
    )    
  }
}

export default connect(state => {
  return {
    articleInfo: state.articleInfo
  }}, dispatch => {
  return {
    changeTag: bindActionCreators(newsTag, dispatch)
  }}
)(withRouter(Article))