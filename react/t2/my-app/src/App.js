import React, {useState, useEffect} from 'react';
//import ReactDOM from 'react-dom';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  //Link
  useLocation,
} from "react-router-dom";

import Header from './components/header/View'
import Footer from './components/footer/View'
import Preloader from './components/preloader/View'
import SliderMain from './components/slidermain/View'
import Services from './components/services/View'
import ServicesFull from './components/services/BlockFull'
import Achievements from './components/achievements/View'
import Prices from './components/prices/View'
import Testimonials from './components/testimonials/View'
import Seo from './components/seo/View'
import Team from './components/team/View'
import TeamFull from './components/team/BlockFull'
import About from './components/about/View'
import Clients from './components/clients/View'
import News from './components/news/View'
import Article from './components/article/View'
import Contacts from './components/contacts/View'
import Map from './components/contacts/Map'

import intersectionObserver from './utils/intersectionObserver'


function App() {
  const [preloader, setPreloader] = useState(true);
  useEffect(() => {
    setPreloader(false);
  }, []);

  return (
    <Router>
      <Main />

      <Footer />

      <Header />

      <Preloader preloader={preloader} />
    </Router>
  );
} 

function Main() {
  const location = useLocation();

  useEffect(() => {
    intersectionObserver();
  }, [location]);

  const { pathname } = useLocation();

  useEffect(() => {
    window.scrollTo(0, 0);
  }, [pathname]);

  return (
    <main className="main">
      <Switch>
        {/*<Route path="/test">
          <Test />
        </Route>*/}
        <Route path="/about">
          <About observer={true} />
          <Achievements />
          <Clients observer={true} />
          <TeamFull observer={true} />
        </Route>
        <Route path="/services">
          <ServicesFull observer={true} />
          <Prices observer={true} />
          <Testimonials observer={true} />
        </Route>
        <Route path="/news">
          <News />
        </Route>
        <Route path="/article:id">
          <Article observer={true} />
        </Route>
        <Route path="/contacts">
          <Contacts observer={true} />
          <Map observer={true} />
        </Route>
        <Route path="/">
          <SliderMain />
          <Services observer={true} />
          <Achievements />
          <Prices observer={true} />
          <Testimonials observer={true} />
          <Seo observer={true} />
          <Team observer={true} />
        </Route>
      </Switch>
    </main>
  );
}

export default App;