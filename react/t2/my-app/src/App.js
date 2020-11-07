import React from 'react';
import ReactDOM from 'react-dom';
import './App.css';

import Header from './components/header/View'
import Footer from './components/footer/View'
/*import SliderMain from './components/SliderMain/View'
import Advantages from './components/Advantages/View'
import PhoneScreen from './components/PhoneScreen/View'
import Portfolio from './components/Portfolio/View'
import FormBuy from './components/FormBuy/View'*/

function App() {
  return (
    <React.Fragment>
      <main className="main">
        {/*<SliderMain />
              <Advantages />
              <PhoneScreen />
              <Portfolio />
              <FormBuy />*/}
      </main>

      <Footer />

      <Header />
    </React.Fragment>
  );
}

export default App;