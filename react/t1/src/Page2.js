import React, { Component } from 'react'
import { Link, withRouter } from 'react-router-dom'


class Page2 extends React.Component{
	constructor(props){
		super(props);
		this.state = {

		}
	}

	componentDidMount(){
		console.log(this.props.location)
	}

	render(){

		return (
			<div>test</div>
		)
	}
}

export default withRouter(Page2);