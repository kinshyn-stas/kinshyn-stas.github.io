import {createStore} from 'redux'
import {reducer} from './reducer.js'
import {ACTION_1} from './constants'

export const store = createStore(reducer, {
	test: 'test-0',
});

//store.dispatch({ type: ACTION_1, test: 'test-1' });