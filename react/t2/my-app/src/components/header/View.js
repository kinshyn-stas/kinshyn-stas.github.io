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
    }
  }

  render() {
    const { match, location, history } = this.props;

    return (
      <React.Fragment>
        <header className="header-main">
          <div className="center-main-block">

            <figure className="header_logo">
              <img src={LogoHeader} alt="" />
            </figure>

            {/*<Search className="header_search-m" onClick={() => this.setState({ isSearch: !this.state.isSearch })} />*/}

            <a className="header_switch" onClick={() => this.setState({ contentSwitch: !this.state.contentSwitch })}>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 15.5V17.5H22V15.5H2ZM2 10.5V12.5H22V10.5H2ZM2 5.5V7.5H22V5.5H2Z" fill="#ffffff"/>
              </svg>
            </a>

            <div className={`header_content ${this.state.contentSwitch ? 'active' : ''}`}>

              <nav className="header_nav">
                <ul>
                  <li><Link to={`/`} className={`header_nav_link ${location.pathname ===  '/' ? 'active' : ''}`}>Home</Link></li>
                  <li><Link to={`/about`} className={`header_nav_link ${location.pathname ===  '/about' ? 'active' : ''}`}>About</Link></li>
                  <li><Link to={`/services`} className={`header_nav_link ${location.pathname ===  '/services' ? 'active' : ''}`}>Services</Link></li>
                  {/*<li><Link to={`/projects`} className={`header_nav_link ${location.pathname ===  '/projects' ? 'active' : ''}`}>Projects</Link></li>*/}
                  <li><Link to={`/news`} className={`header_nav_link ${location.pathname ===  '/news' ? 'active' : ''} ${location.pathname ===  '/article' ? 'active' : ''}`}>News</Link></li>
                  <li><Link to={`/contact`} className={`header_nav_link ${location.pathname ===  '/contact' ? 'active' : ''}`}>Contact</Link></li>
                </ul>
              </nav>

              <Search className="header_search-d" onClick={() => this.setState({ isSearch: !this.state.isSearch })} />

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