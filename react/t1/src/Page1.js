import React, { Component } from 'react'
import { Link, withRouter } from 'react-router-dom'


function Page1(props){
  let id = 12;

  return (
    <Link to={{ pathname: `/page2/${id}`, state: { test: 't1' }, test: 't2' }}>
        page2
    </Link>
  )
}

export default withRouter(Page1);