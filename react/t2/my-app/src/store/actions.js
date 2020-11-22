import {ACTION_1} from './constants'

export function action_1(value) {
	console.log(value)
    return { 
        type: ACTION_1,
        test: value.test
    };
}