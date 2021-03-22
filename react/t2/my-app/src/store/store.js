import {createStore} from 'redux'
import {reducer} from './reducer.js'
import {NewsTag, ArticleInfo} from './constants'

const preState = {
	newsTag: undefined,
	articleInfo: undefined,
}

const saveState = (state) => {
    try {
        const serialisedState = JSON.stringify(state);
        window.localStorage.setItem('app_state', serialisedState);
    } catch (err) {
    	console.log(err)
    }
};

const loadState = () => {
    try {
        const serialisedState = window.localStorage.getItem('app_state');
        if (!serialisedState) return preState;
        return JSON.parse(serialisedState);
    } catch (err) {
        return preState;
    }
};

const oldState = loadState();
export const store = createStore(reducer, oldState);


store.subscribe(() => {
    saveState(store.getState());
});