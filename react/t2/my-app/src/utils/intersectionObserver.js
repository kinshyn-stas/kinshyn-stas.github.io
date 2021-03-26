export default function intersectionObserver(o = {}){
	let c = o.className ? o.className : '.observer';
    let v = ['top','left','right','bottom'];

	const options = {
        root: o.parent ? o.parent : null,
        rootMargin: '0px',
        threshold: 0.2
    }

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target
                target.classList.add('observer-active')   

                target.querySelectorAll('.observer_item').forEach((item,i,arr) => {
                    item.style.animationDelay = `${2 * i / arr.length}s`;

                    if(target.dataset.observerdirection){
                        switch(target.dataset.observerdirection){
                            case 'none':
                                break;
                            case 'opacity':
                                item.classList.add('observer_item-opacity')
                                break;
                            case 'top':
                                item.classList.add('observer_item-top')
                                break;
                            case 'right':
                                item.classList.add('observer_item-right')
                                break;
                            case 'bottom':
                                item.classList.add('observer_item-bottom')
                                break;
                            case 'left':
                            default:
                                item.classList.add('observer_item-left')
                                break;
                        }
                    } else if(target.dataset.observerrandom){
                        let n = i;
                        if(n >= v.length) n = parseInt(n / v.length) * n - v.length - 1;
                        item.classList.add(`observer_item-${v[n]}`)
                    }
                })
                observer.unobserve(target)
            }
        })
    }, options)

    let arr = document.querySelectorAll(c)
    if(o.parent){
    	arr = o.parent.querySelectorAll(c)
    } else {
    	arr = document.querySelectorAll(c)
    }

    arr.forEach(i => {
        observer.observe(i)
    });

    /*document.addEventListener('transitionend', (e) => {
        console.log(e)
    })*/
}