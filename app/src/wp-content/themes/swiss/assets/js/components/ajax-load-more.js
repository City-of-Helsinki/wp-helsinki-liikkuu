const React = require('react');
const ReactDOM = require('react-dom');

const parsedUrl = location.href.split('/tag/');

let TagFromUrl = null;

if(parsedUrl.length > 1) {
    TagFromUrl = parsedUrl[1].split('/')[0];
}

//console.log(TagFromUrl);

const Loading = props => {
    return (
        <div className="c-loading">
            <div className="c-loading__inner"></div>
            <div className="c-loading__inner"></div>
            <div className="c-loading__inner"></div>
        </div>
    );
};

const Tag = props => {
    const tagClass = "c-btn c-tag-filter " + props.class;
    return (
        <div className={tagClass} tabIndex="0" onKeyUp={props.onKeyUp} onClick={props.onClick}>
            {props.name}
        </div>
    );
};

const Item = ({data: {post_title,post_image,post_permalink,post_date,event_location,event_starts,event_ends, custom_class}}) => {
    const style = {
        backgroundImage: "url("+post_image+")",
    };
    const classes = 'c-card trigger-hover '+custom_class;

    const eventFields =  event_starts ? (<div className="c-card__event-fields">
    <div className="c-card__event-time"><i className="c-icon c-icon__clock"></i>{event_starts}</div>
    <div className="c-card__event-location"><i className="c-icon c-icon__marker"></i>{event_location}</div>
    </div>) : ('') ;

    const meta = (<div className="c-card__meta">{post_date}</div>);

    return (

    <div className="l-cards__item">
        <div className={classes}>
        <a className="c-card__imagewrapper" href={post_permalink}><div className="c-card__image" style={style}>
        {meta}
        </div></a>
            <div className="c-card__content">

                <h4 className="c-card__title"><a href={post_permalink} title={post_title}>{post_title}</a></h4>
                {eventFields}
                <div className="c-card__readmore"><a href={post_permalink} className="c-cta-link">{window.swissLocalization['read_more']}</a></div>

            </div>

        </div>
    </div>
    );
};

class Filter extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            allWpPosts: [],
            wpPosts: [],
            tags: [],
            loading: true,
            start: 0,
            end: 9,
            perPage: 3,
            activeTag: null
        };

        this.handleShowMore = this.handleShowMore.bind(this);

    }

    fetchData() {
        const lang = $('html').attr('data-wpml');
        var ajaxurl = lang ? '/'+lang+'/wp-json/swiss/v1/posts/' : '/wp-json/swiss/v1/posts/';
        $.ajax({
            url: ajaxurl,
            type: 'GET',
            success: function(data) {
                let allTags = [];
                for (let key in data) {
                    let postTags = data[key]['post_tags'] ? data[key]['post_tags'].map(tag => tag.name) : [];
                    postTags = postTags.filter(tag => allTags.indexOf(tag) == -1 && tag.length > 0);
                    allTags = allTags.concat(postTags);
                }
                this.setState((prevState, props) => {
                    return { allWpPosts: data, wpPosts: data, loading: false, tags:allTags };
                });
                if (TagFromUrl) {
                    this.filterByTag(TagFromUrl);
                }
                if (this.state.allWpPosts.length <= this.state.end) {
                    $('.js-loadmore').hide();
                }
            }.bind(this),
        });
    }

    componentDidMount(){
        this.fetchData();
    }

    handleShowMore(e){
        e.preventDefault();
        this.setState(
            (prevState) => {
            return {end: prevState.end + prevState.perPage};
            }
        );
        if (this.state.end+this.state.perPage >= this.state.wpPosts.length) {
            $('.js-loadmore').hide();
        }
    }

    filterByTag(tag) {
        if (tag == 'clear-all-filters') {
            let allWpPosts = [...this.state.allWpPosts];
            $('.c-card').addClass('c-card--removing');
            setTimeout(() => {
                this.setState({
                    wpPosts: allWpPosts,
                    activeTag: null
                });
                $('.c-card').removeClass('c-card--removing');
            }, 100);
            if (allWpPosts.length > this.state.end) {
                $('.js-loadmore').show();
            }
            return;
        }
        let wpPostsWithTag = [];
        for (let key in this.state.allWpPosts) {
            let activeTags = 0;
            for (let key2 in this.state.allWpPosts[key].post_tags) {
                if (this.state.allWpPosts[key].post_tags[key2].name == tag) {
                    activeTags+=1;
                }
            }
            if (activeTags > 0) {
                wpPostsWithTag.push(this.state.allWpPosts[key]);
            }
        }
        $('.c-card').addClass('c-card--removing');
        setTimeout(() => {
        this.setState({
            wpPosts: wpPostsWithTag,
            activeTag: tag
        });
        $('.c-card').removeClass('c-card--removing');
    }, 100);
        if (wpPostsWithTag.length <= this.state.end) {
            $('.js-loadmore').hide();
        }
        else {
            $('.js-loadmore').show();
        }
    }

    /**
     * Handler for `enter` keypresses to allow keyboard usage of this component.
     * @param  {[type]} e    [Event]
     * @param  {[type]} item [WP Post item]
     * @return {[type]}      [description]
     */
    handleKeyPress(e, item) {
        if (e.keyCode == 13) {
            this.filterByTag(item);
        }
    }

    render() {

        // a very dirty way to create a array of filtered wpPosts
        const wpPosts = this.state.wpPosts.slice(this.state.start, this.state.end);
        const tags = this.state.tags;

        return (
            <React.Fragment>


                <div className="b-blog__filters"><div className="b-container b-blog__filters--inner">
                <div>
                <span className="b-blog__filters--cta">{window.swissLocalization['filter']}:</span>
                {tags.map(item => item === this.state.activeTag ? <Tag key={item} class="active" name={item} onKeyUp={(e) => this.handleKeyPress(e, item)} onClick={() => this.filterByTag(item)}/> : <Tag key={item} class="default" name={item} onKeyUp={(e) => this.handleKeyPress(e, item)} onClick={() => this.filterByTag(item)}/>) }
                </div><button className="c-tag-filter c-tag-filter--clear c-btn" onClick={() => this.filterByTag('clear-all-filters')}
                >{window.swissLocalization['remove_filters']}</button>
                </div></div>
                <div className="b-blog__posts-listing">
                {this.state.loading && <Loading />}
                <div className="l-cards">
                {wpPosts.map(item => <Item key={item.ID} data={item}/>)}
                </div></div>
                <a className="b-blog__loadmore" href="#" onClick={this.handleShowMore}><button className="c-btn js-loadmore">{window.swissLocalization['show_more']}</button></a>

            </React.Fragment>
        );
    }
}

if($('.js-ajax-loadmore-content').length) {
    ReactDOM.render(<Filter />, document.querySelector('.js-ajax-loadmore-content'));
}