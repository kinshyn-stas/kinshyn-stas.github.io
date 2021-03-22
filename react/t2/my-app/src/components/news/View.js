import React from 'react';
import { withRouter, Link } from "react-router-dom";

import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {newsTag, articleInfo} from '../../store/actions.js';

import Preloader from '../preloader/View'

import Img0 from '../../assets/img/news/news-0.jpg'
import Img1 from '../../assets/img/news/news-1.jpg'


class News extends React.Component{
  constructor(props){
    super(props);
    this.state = {
      items: [
        {
          id: 0,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '25-11-2021',
          tags: ['tag1','tag2','tag3']
        },
        {
          id: 1,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '24-11-2021',
          tags: ['tag1','tag2','tag4']
        },
        {
          id: 2,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '23-11-2021',
          tags: ['tag1','tag2','tag3','tag4']
        },
        {
          id: 3,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '22-11-2021',
          tags: ['tag1','tag2','tag3','tag4']
        },
        {
          id: 4,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '21-11-2021',
          tags: ['tag2','tag3']
        },
        {
          id: 5,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '20-11-2021',
          tags: ['tag2']
        },
        {
          id: 6,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '19-11-2021',
          tags: ['tag1']
        },
        {
          id: 7,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '18-11-2021',
          tags: ['tag4']
        },
        {
          id: 8,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '17-11-2021',
          tags: ['tag1']
        },
        {
          id: 9,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '16-11-2021',
          tags: ['tag2']
        },
        {
          id: 10,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '15-11-2021',
          tags: ['tag1']
        },
        {
          id: 11,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '14-11-2021',
          tags: ['tag2']
        },
        {
          id: 12,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '13-11-2021',
          tags: ['tag2']
        },
        {
          id: 13,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '12-11-2021',
          tags: ['tag2']
        },
        {
          id: 14,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '11-11-2021',
          tags: ['tag1']
        },
        {
          id: 15,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '10-11-2021',
          tags: ['tag2','tag4']
        },
        {
          id: 16,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '9-11-2021',
          tags: ['tag1']
        },
        {
          id: 17,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '8-11-2021',
          tags: ['tag1']
        },
        {
          id: 18,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '7-11-2021',
          tags: ['tag2','tag3']
        },
        {
          id: 19,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '6-11-2021',
          tags: ['tag2','tag4']
        },
        {
          id: 20,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '5-11-2021',
          tags: ['tag1']
        },
        {
          id: 21,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '4-11-2021',
          tags: ['tag4']
        },
        {
          id: 22,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '3-11-2021',
          tags: ['tag1']
        },
        {
          id: 23,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '2-11-2021',
          tags: ['tag4']
        },
        {
          id: 24,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '1-11-2021',
          tags: ['tag2','tag3']
        },
        {
          id: 25,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '30-10-2021',
          tags: ['tag2']
        },
        {
          id: 26,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '29-10-2021',
          tags: ['tag1']
        },
        {
          id: 27,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '28-10-2021',
          tags: ['tag2']
        },
        {
          id: 28,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '27-10-2021',
          tags: ['tag3']
        },
        {
          id: 29,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '26-10-2021',
          tags: ['tag2']
        },
        {
          id: 30,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '25-10-2021',
          tags: ['tag3']
        },
        {
          id: 31,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '24-10-2021',
          tags: ['tag2']
        },
        {
          id: 32,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '23-10-2021',
          tags: ['tag2','tag4']
        },
        {
          id: 33,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '22-10-2021',
          tags: ['tag1']
        },
        {
          id: 34,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '21-10-2021',
          tags: ['tag3']
        },
        {
          id: 35,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '20-10-2021',
          tags: ['tag2','tag3']
        },
        {
          id: 36,
          img: Img0,
          title: 'Proin dapibus in nisl in vestibulum',
          text: 'Phasellus porta interdum ipsum non dictum. Etiam quis risus sed libero pulvinar sollicitudin ac at odio. Vivamus commodo augue sed nunc ullamcorper, at mattis dui condimentum. Mauris sagittis sit amet massa eu aliquet. Phasellus eu libero vel risus convallis cursus. Fusce semper vestibulum ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent rutrum nulla id blandit tempor.',
          date: '19-10-2021',
          tags: ['tag1']
        },
        {
          id: 37,
          img: Img1,
          title: 'Suspendisse vitae ligula convallis',
          text: 'Quisque consectetur dolor nec mauris pretium tempus. Fusce congue, leo a bibendum vehicula, quam elit lacinia sapien, non pulvinar metus mauris vel justo. Vivamus pharetra rhoncus venenatis. Maecenas sapien dui, luctus at felis at, suscipit convallis urna. Quisque eu fermentum elit. Pellentesque et felis dolor. Maecenas est sem, sollicitudin nec maximus vel, efficitur vitae risus. Vestibulum laoreet varius vulputate.',
          date: '18-10-2021',
          tags: ['tag2']
        },
      ],
      itemsShow: [],
      page: 1,
      itemOnPage: 5,
      tag: null,
      tags: ['tag1','tag2','tag3','tag4'],
      preloader: false,
    }
  }

  componentDidMount(){
    let arr = this.state.items.slice(0,this.state.itemOnPage);
    this.setState({itemsShow: arr});
    if(this.props.newsTag){
      this.changeArticleInfo(this.props.newsTag)
      this.props.changeArticleInfo({newsTag: ''})
    } 
  }

  componentDidUpdate(prevProps,prevState){
    if(prevState.itemsShow !== this.state.itemsShow){
      this.changeLastPage();
    }
  }

  changeLastPage(){
    let arr = this.state.items;
    if(this.state.tag){
      arr = [];
      this.state.items.forEach(item => {
        if(item.tags.includes(this.state.tag)) arr.push(item);
      })
    }

    let lastPage = parseInt(arr.length / this.state.itemOnPage);
    this.setState({lastPage: lastPage});
  };

  changePage(n){
    if(n === this.state.page) return;
    let arr1 = [];
    let arr2 = [];

    this.state.items.forEach(item => {
      if(this.state.tag && !item.tags.includes(this.state.tag)) return null;        
      arr1.push(item);
    })

    arr1.forEach((item,i) => {
      if(parseInt(i / this.state.itemOnPage) !== n) return null;  
      arr2.push(item);    
    })

    this.setState({itemsShow: arr2, page: n, preloader: true}, () => {
      this.setState({preloader: false})
    });
  }

  changeArticleInfo(tag){
    if(tag === this.state.tag) return;

    let arr = [];
    this.state.items.forEach(item => {
      if(tag){
        if(arr.length < this.state.itemOnPage && item.tags.includes(tag)) arr.push(item);
      } else {
        if(arr.length < this.state.itemOnPage) arr.push(item);
      }      
    })

    this.setState({itemsShow: arr, tag: tag, page: 1, preloader: true}, () => {
      this.setState({preloader: false})
    });
  }

  renderItem(item,i){
    return (
      <div className={`news_item ${this.props.observer ? 'observer_item' : ''}`} key={`news_item-${item.id}`}>
        <figure>
          <img src={item.img} alt={item.title ? item.title : ''} />
        </figure>
        <div className="news_item_content">
          <Link to={`/article:${item.id}`} className="news_item_content_title">{item.title}</Link>
          <div className="news_item_content_text">{item.text}</div>
          <div className="news_item_content_bottom">
            <Link className="news_item_content_bottom_read" to={`/article:${item.id}`} onClick={() => this.props.changeArticleInfo({articleInfo: item})}>Read more</Link>
            <time>{item.date}</time>
            <div className="news_item_tags">
              {!!item.tags.length && item.tags.map((tag,i) => {   
                return (
                  <a className={`news_item_tags_item ${this.state.tag === tag ? 'active' : ''}`} key={`news_item_tags_item-${i}`} onClick={() => this.changeArticleInfo(tag)}>#{tag}</a>
                )
              })}
            </div>
          </div>
        </div>
      </div>
    )
  }

  render(){
    return (
      <React.Fragment>
        <section className={`main-block news_block ${this.props.observer ? 'observer' : ''}`}>  
          <div className="center-main-block">
            <div className="news_content">
              <div className="news_box">
                {this.state.itemsShow.map((item,i) => this.renderItem(item,i))}
              </div>
              {this.state.tags && !!this.state.tags.length && (
                <div className="news_aside">
                  <div className="news_aside_tags">
                    <h4>Select tag</h4>
                    <a className={`news_aside_tags_item ${this.state.tag === null ? 'active' : ''}`}  onClick={() => this.changeArticleInfo(null)}>All</a>
                    {this.state.tags.map(tag => {
                      return (
                        <a className={`news_aside_tags_item ${this.state.tag === tag ? 'active' : ''}`} key={`news_aside_tags_item-${tag}`}  onClick={() => this.changeArticleInfo(tag)}>#{tag}</a>
                      )
                    })}
                  </div>
                </div>
              )}
            </div>

            <div className="pagination">
              <a className={`pagination_arrow pagination_arrow-left ${this.state.page===1 ? 'disabled' : ''}`} onClick={() => this.changePage(1)}>
                <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.67 1.87L9.9 0.1L0 10L9.9 19.9L11.67 18.13L3.54 10L11.67 1.87Z" fill="#0A0A0A"/>
                </svg>
              </a>
              {this.state.page>2 && <a className="pagination_number" onClick={() => this.changePage(this.state.page - 2)}>{this.state.page - 2}</a>}
              {this.state.page>1 && <a className="pagination_number" onClick={() => this.changePage(this.state.page - 1)}>{this.state.page - 1}</a>}
              <a className="pagination_number active">{this.state.page}</a>
              {this.state.lastPage>=this.state.page + 1 && <a className="pagination_number" onClick={() => this.changePage(this.state.page + 1)}>{this.state.page + 1}</a>}
              {this.state.lastPage>=this.state.page + 2 && <a className="pagination_number" onClick={() => this.changePage(this.state.page + 2)}>{this.state.page + 2}</a>}
              <a className={`pagination_arrow pagination_arrow-left ${this.state.page===this.state.lastPage ? 'disabled' : ''}`} onClick={() => this.changePage(this.state.lastPage)}>
                <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M-1.90735e-06 1.87L1.77 0.1L11.67 10L1.77 19.9L-1.90735e-06 18.13L8.13 10L-1.90735e-06 1.87Z" fill="#0A0A0A"/>
                </svg>
              </a>
            </div>
          </div>
        </section>

        <Preloader preloader={this.state.preloader} />
      </React.Fragment>
    )    
  }
}

export default connect(state => {
  return {
    newsTag: state.newsTag
  }}, dispatch => {
  return {
    changeArticleInfo: bindActionCreators(articleInfo, dispatch)
  }}
)(withRouter(News))