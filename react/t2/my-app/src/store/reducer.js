import {NewsTag, ArticleInfo} from './constants'

export function reducer(state, action){
    switch(action.type) {
        case NewsTag: return { newsTag: action.newsTag };
        case ArticleInfo: return { articleInfo: action.articleInfo };
        
        default: return state;
    }
}