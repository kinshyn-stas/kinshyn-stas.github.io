import React from 'react';
import { withRouter, Link } from "react-router-dom";

import LogoHeader from '../../assets/img/LogoHeader.svg'
import Search from './Search.js'

class Header extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      isSearch: false,
      contentSwitch: false,
      contentAnimationName: 1,
    }
  }

  componentDidUpdate(prevProps){
    if(prevProps.location.pathname !== this.props.location.pathname){
      this.setState({ contentSwitch: false })
    }
  }

  render() {
    const { match, location, history } = this.props;
    let an = `${this.state.contentAnimationName ? 'showOpacity' : ''}`;

    return (
      <React.Fragment>
        <header className="header-main">
          <div className="center-main-block">

            <figure className="header_logo">
              <img src={LogoHeader} alt="" />
            </figure>

            {/*<Search className="header_search-m" onClick={() => this.setState({ isSearch: !this.state.isSearch })} />*/}

            <a className={`header_switch ${this.state.contentSwitch ? 'active' : ''}`} onClick={() => this.setState({ contentSwitch: !this.state.contentSwitch, contentAnimationName: 0},() => {
              let k = this.state.contentAnimationName + 1;
              setTimeout(() => {
                this.setState({contentAnimationName: k})
              }, 0)
            })}>
              <svg className="header_switch_open" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style={{animationName: an}}>
                <path d="M2 15.5V17.5H22V15.5H2ZM2 10.5V12.5H22V10.5H2ZM2 5.5V7.5H22V5.5H2Z" fill="#ffffff"/>
              </svg>
              <svg className="header_switch_close" width="24" height="24" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" style={{animationName: an}}>
                <path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z" fill="#ffffff"/>
              </svg>
            </a>

            <div className={`header_content ${this.state.contentSwitch ? 'active' : ''}`}>

              <nav className="header_nav">
                <ul>
                  <li><Link to={`/`} className={`header_nav_link ${location.pathname ===  '/' ? 'active' : ''}`}>Home</Link></li>
                  <li><Link to={`/about`} className={`header_nav_link ${location.pathname ===  '/about' ? 'active' : ''}`}>About</Link></li>
                  <li><Link to={`/services`} className={`header_nav_link ${location.pathname ===  '/services' ? 'active' : ''}`}>Services</Link></li>
                  <li><Link to={`/news`} className={`header_nav_link ${location.pathname ===  '/news' ? 'active' : ''} ${location.pathname.indexOf('/article') != -1 ? 'active' : ''}`}>News</Link></li>
                  <li><Link to={`/contacts`} className={`header_nav_link ${location.pathname ===  '/contacts' ? 'active' : ''}`}>Contacts</Link></li>
                </ul>
              </nav>

              {/*<Search className="header_search-d" onClick={() => this.setState({ isSearch: !this.state.isSearch })} /> */}

            </div>

          </div>
        </header>


        {this.state.isSearch && (
          <div className="popup_container">
            <div className="popup_background" onClick={() => this.setState({ isSearch: false })}></div>
            <div className="popup">Тут типа поиск</div>
          </div>
        )}
      </React.Fragment>
    )    
  }
}

export default withRouter(Header)