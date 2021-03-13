import React from 'react';

import LogoHeader from '../../assets/img/LogoHeaderBlack.svg'


export default class Footer extends React.Component{
  constructor(props){
    super(props);
    this.state = {
    }
  }

  render() {

    return (
      <footer className="footer-main">
        <div className="center-main-block">

          <figure className="footer_logo">
            <img src={LogoHeader} alt="" />
          </figure>

          <div className="footer_soc">

            <a href="http://facebook.com" className="footer_soc_item" target="_blank">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                <defs>
                    <linearGradient id="fj8l2ujs6a" x1="50%" x2="50%" y1="0%" y2="100%">
                        <stop offset="0%" stopColor="#00BCE1"/>
                        <stop offset="100%" stopColor="#007BDF"/>
                    </linearGradient>
                </defs>
                <g fill="none" fillRule="evenodd">
                    <circle cx="20" cy="20" r="20" fill="url(#fj8l2ujs6a)"/>
                    <path fill="#FFF" fillRule="nonzero" d="M19.662 10c5.89 0 10.663 4.395 10.663 9.817 0 5.421-4.774 9.816-10.663 9.816-1.098 0-2.159-.153-3.156-.436l-3.579 2.007v-3.776C10.531 25.628 9 22.887 9 19.817 9 14.395 13.774 10 19.662 10zm6.797 7.128l-5.175 2.784-2.76-2.784-5.75 6.008 5.233-2.834 2.734 2.834 5.718-6.008z"/>
                </g>
              </svg>
            </a>

            <a href="http://instagram.com" className="footer_soc_item" target="_blank">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                <defs>
                    <linearGradient id="eu6cymgiva" x1="6.714%" x2="93.608%" y1="93.485%" y2="6.619%">
                        <stop offset="0%" stopColor="#FD5"/>
                        <stop offset="50%" stopColor="#FF543E"/>
                        <stop offset="100%" stopColor="#C837AB"/>
                    </linearGradient>
                </defs>
                <g fill="none" fillRule="evenodd">
                    <circle cx="18" cy="18" r="18" fill="url(#eu6cymgiva)"/>
                    <path fill="#FFF" fillRule="nonzero" d="M18 9c-2.443 0-2.75.01-3.71.054-.958.044-1.612.196-2.185.419-.592.23-1.094.537-1.594 1.037-.5.5-.808 1.003-1.039 1.594-.223.573-.375 1.227-.418 2.185C9.011 15.249 9 15.556 9 18s.01 2.75.054 3.71c.044.958.196 1.612.419 2.184.23.592.537 1.095 1.038 1.595.5.5 1.002.809 1.593 1.038.573.223 1.227.375 2.185.419.96.043 1.267.054 3.71.054 2.445 0 2.751-.01 3.711-.054.958-.044 1.613-.196 2.186-.419.591-.23 1.093-.538 1.593-1.038s.808-1.003 1.038-1.594c.222-.573.374-1.227.419-2.185.043-.96.054-1.266.054-3.71s-.011-2.751-.054-3.711c-.045-.958-.197-1.612-.419-2.184-.23-.592-.538-1.094-1.038-1.595-.5-.5-1.002-.808-1.594-1.037-.574-.223-1.228-.375-2.186-.419-.96-.043-1.266-.054-3.711-.054h.003zm-.807 1.622h.808c2.403 0 2.688.008 3.637.052.877.04 1.353.186 1.67.31.42.163.72.358 1.035.673.315.315.51.615.673 1.035.124.317.27.793.31 1.67.043.95.053 1.234.053 3.636s-.01 2.687-.053 3.636c-.04.877-.186 1.353-.31 1.67-.163.42-.358.72-.673 1.034-.315.315-.614.51-1.034.673-.317.124-.794.27-1.671.31-.95.043-1.234.053-3.637.053s-2.688-.01-3.637-.053c-.877-.04-1.354-.187-1.671-.31-.42-.163-.72-.358-1.035-.673-.315-.315-.51-.614-.674-1.035-.123-.316-.27-.793-.31-1.67-.043-.949-.051-1.234-.051-3.637 0-2.404.008-2.687.051-3.636.04-.877.187-1.354.31-1.67.163-.42.359-.72.674-1.036.315-.315.615-.51 1.035-.673.317-.124.794-.27 1.671-.31.83-.038 1.152-.05 2.83-.051v.002zm5.612 1.494c-.596 0-1.08.483-1.08 1.08 0 .596.484 1.08 1.08 1.08.596 0 1.08-.484 1.08-1.08 0-.596-.484-1.08-1.08-1.08zm-4.804 1.262c-2.553 0-4.622 2.07-4.622 4.622s2.07 4.62 4.622 4.62 4.621-2.068 4.621-4.62-2.069-4.622-4.621-4.622zM18 15c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3z"/>
                </g>
              </svg>
            </a>

            <a href="http://web.telegram.org" className="footer_soc_item" target="_blank">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                <defs>
                    <linearGradient id="9hcc6bxhka" x1="66.67%" x2="41.67%" y1="16.67%" y2="75%">
                        <stop offset="0%" stopColor="#37AEE2"/>
                        <stop offset="100%" stopColor="#1E96C8"/>
                    </linearGradient>
                    <linearGradient id="8epqt6ye5b" x1="61.235%" x2="74.706%" y1="45.561%" y2="71.273%">
                        <stop offset="0%" stopColor="#EFF7FC"/>
                        <stop offset="100%" stopColor="#FFF"/>
                    </linearGradient>
                </defs>
                <g fill="none">
                    <circle cx="20" cy="20" r="20" fill="url(#9hcc6bxhka)"/>
                    <path fill="#C8DAEA" d="M16.871 27.395c-.544 0-.451-.206-.64-.724l-1.6-5.267 12.32-7.31"/>
                    <path fill="#A9C9DD" d="M16.871 27.395c.42 0 .606-.192.84-.42l2.24-2.178-2.794-1.685"/>
                    <path fill="url(#8epqt6ye5b)" d="M17.157 23.112l6.77 5.002c.773.427 1.33.206 1.523-.717l2.756-12.987c.282-1.131-.431-1.644-1.17-1.309l-16.183 6.24c-1.105.443-1.098 1.06-.201 1.334l4.152 1.296 9.615-6.065c.454-.275.87-.127.528.176"/>
                </g>
              </svg>
            </a>

          </div>

          <p className="footer_copyright">Stas ©. All rights reserved.</p>

        </div>
      </footer>
    )    
  }
}