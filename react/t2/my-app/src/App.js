import React from 'react';
import ReactDOM from 'react-dom';

import Header from './components/header/View'
import Footer from './components/footer/View'
import SliderMain from './components/slidermain/View'
import Services from './components/services/View'
import Achievements from './components/achievements/View'

function App() {
  return (
    <React.Fragment>
      <main className="main">
        <SliderMain />
        <Services />
        <Achievements />
      </main>

      <Footer />

      <Header />
    </React.Fragment>
  );
}

export default App;