import {ACTION_1} from './constants'

export function reducer(state, action){
    switch(action.type) {
        case ACTION_1: return { test: action.test + '_1' };
        
        default: return state;
    }
}