import {NewsTag, ArticleInfo} from './constants'

export function newsTag(value) {
    return { 
        type: NewsTag,
        newsTag: value.newsTag
    };
}

export function articleInfo(value) {
    return { 
        type: ArticleInfo,
        articleInfo: value.articleInfo
    };
}