import {ACTION_1} from './constants'

export function action_1(value) {
    return { 
        type: ACTION_1,
        test: value.test
    };
}