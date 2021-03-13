import React from 'react';
import ReactDOM from 'react-dom';
import {Provider} from 'react-redux';
import './assets/css/style.css';
import App from './App';
import {store} from './store/store.js'

ReactDOM.render(
  <Provider store={store}>
    <App />
  </Provider>,
  document.getElementById('root')
);