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
import Achievements from './components/achievements/View'
import Prices from './components/prices/View'
import Testimonials from './components/testimonials/View'
import Seo from './components/seo/View'
import Team from './components/team/View'
import About from './components/about/View'
import Clients from './components/clients/View'

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

  return (
    <main className="main">
      <Switch>
        <Route path="/about">
          <About observer={true} />
          <Clients observer={true} />
          <Team observer={true} />
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