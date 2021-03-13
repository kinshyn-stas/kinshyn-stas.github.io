import React, {useState, useEffect} from 'react';
//import ReactDOM from 'react-dom';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  //Link
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

import intersectionObserver from './utils/intersectionObserver'


function App() {
  const [preloader, setPreloader] = useState(true);

  useEffect(() => {
    setPreloader(false)
  });

  intersectionObserver();

  return (
    <Router>
      <main className="main">
        <Switch>
          <Route path="/about" component={Services} />
          <Route path="/">
            <SliderMain />
            <Services />
            <Achievements />
            <Prices />
            <Testimonials />
            <Seo />
            <Team />
          </Route>
        </Switch>
      </main>

      <Footer />

      <Header />

      <Preloader preloader={preloader} />
    </Router>
  );
}

export default App;