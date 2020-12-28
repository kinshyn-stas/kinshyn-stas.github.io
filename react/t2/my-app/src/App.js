import React from 'react';
import ReactDOM from 'react-dom';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

import Header from './components/header/View'
import Footer from './components/footer/View'
import SliderMain from './components/slidermain/View'
import Services from './components/services/View'
import Achievements from './components/achievements/View'
import Prices from './components/prices/View'

function App() {
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
          </Route>
        </Switch>
      </main>

      <Footer />

      <Header />
    </Router>
  );
}

export default App;