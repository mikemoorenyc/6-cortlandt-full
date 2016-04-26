var MainPress = React.createClass({
  getInitialState: function() {
    return {
      title: $('#unsafe-values .title').text(),
      excerpt: $('#unsafe-values .excerpt').text(),
      linkType: APP.linkType,
      linkID: APP.linkID,
      linkURL: APP.linkURL,
      imgID: APP.imgID,
      imgURL: APP.imgURL,
      linkerror: '',
      titleerror: '',
      excerpterror: ''
    }
  },
  stateUpdate: function(key,value) {
    var theState = this.state;
    theState[key] = value;
    this.setState(theState);
  },
  excerptUpdate: function(e) {
    var e = e.target.value;
    this.stateUpdate('excerpt', e);
  },
  titleUpdate: function(e) {
    var e = e.target.value;
    this.stateUpdate('title', e);

    //UPDATE WORDPRESS TITLE
    $('input#title').val(e);
  },
  componentDidMount: function() {
    $('#unsafe-values').remove();
    $('#publishing-action input.button').on('click', function(){

      var conclusion = this.validator();
      if(conclusion === false) {
        return false;
      }
    }.bind(this));
  },
  validator: function() {
    var failed = false;
    if(this.state.title.length <1 || this.state.linkURL.length < 1 || this.state.excerpt.length < 1) {
      failed = true;
    }
    if(this.state.linkURL.length < 1) {
      this.setState({
        linkerror: 'errored'
      });
    } else {
      this.setState({
        linkerror: ''
      });
    }
    if(this.state.title.length < 1) {
      this.setState({
        titleerror: 'errored'
      });
    } else {
      this.setState({
        titleerror: ''
      });
    }
    if(this.state.excerpt.length < 1) {
      this.setState({
        excerpterror: 'errored'
      });
    } else {
      this.setState({
        excerpterror: ''
      });
    }

    //CHECK URL

var myRegExp =/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
  if(this.state.linkType == 'external') {
    if(!myRegExp.test(this.state.linkURL)) {

      failed = true;
      this.setState({
        linkerror: 'errored'
      });
    }
  }

    if(failed === true) {
      return false;
    }
  },
  mediaOpener: function(title, keyprefix, size, documentChange) {
    var image = wp.media({
            title: title,
            multiple: false
        }).open()
        .on('select', function(e){

            var uploaded_image = image.state().get('selection').first();
            var theurl;
            if(typeof(uploaded_image.attributes.sizes) != 'undefined') {
              if(typeof(uploaded_image.attributes.sizes[size]) != 'undefined') {
                theurl = uploaded_image.attributes.sizes[size].url;
              } else {
                theurl = uploaded_image.attributes.url;
              }
            } else {
              theurl = uploaded_image.attributes.url;
            }
            console.log(uploaded_image);
            this.setState({
              [keyprefix+'URL'] : theurl,
              [keyprefix+'ID'] : uploaded_image.id
            });

            if(documentChange) {
              this.setState({
                [keyprefix+'Type']: 'document'
              });
            }


        }.bind(this));
  },
  thumbClick: function(e) {
    e.preventDefault();
    this.mediaOpener('Select an image for this article', 'img', 'medium');
  },
  removeThumb: function(e) {
    e.preventDefault();
    this.stateUpdate('imgURL','');
    this.stateUpdate('imgID', '');
  },
  readChange: function(e) {

    this.setState({
      linkURL: e.target.value
    });
  },
  docAdd: function(e) {
    e.preventDefault();
    this.mediaOpener('Link to a document', 'link', 'full', true);
  },
  docRemove: function(e) {
    e.preventDefault();
    this.setState({
      linkURL: '',
      linkID: '',
      linkType: 'external'
    });
  },
  render: function() {
    var wholeState = this.state;
    var thumb,
        thumbState = 'no-thumb',
        imgHelper = <div className="helper">
                      <span className="dashicons dashicons-format-image"></span>
                      <button className="button button-primary button-small">Add an image</button>
                    </div>,
        removeThumb = 'hidden';

    if(this.state.imgURL) {
      thumb = <img src={this.state.imgURL} />;
      thumbState = 'with-thumb';
      removeThumb = 'visible';
      imgHelper = false;
    }

    var linkInput = <div>
                      <input className={this.state.linkerror} id="input-read-more" placeholder="Valid URL for the whole article" value={this.state.linkURL} type="text" onChange={this.readChange}/>
                      <button className="button button-primary" title={'Link to a document'} onClick={this.docAdd}><span className="dashicons dashicons-welcome-add-page"></span></button>
                    </div>;
    if(this.state.linkType !== 'external') {
      var filename =  this.state.linkURL.replace(/^.*[\\\/]/, '');
      linkInput = <div className="with-file">

                  <span className="filer">
                    <span className="dashicons dashicons-media-default"></span>
                    {filename}
                  </span>
                  <a href="#" className="remover" onClick={this.docRemove}>Remove </a>
                  </div>;
    }
    return (
      <div id="press-entry-point">
        <input id="press_data" name="press_data" value={JSON.stringify(wholeState)} type="hidden" />
        <div className="left-side">
          <div id="title-row">
            <label htmlFor="input-title">Title</label>
            <input className={this.state.titleerror} type="text" id="input-title" value={this.state.title} onChange={this.titleUpdate}/>
          </div>
          <div id="excerpt-row">
            <label htmlFor="input-excerpt">Excerpt</label>
            <textarea className={this.state.excerpterror} id="input-excerpt" value={this.state.excerpt} onChange={this.excerptUpdate} maxLength={150}/>
            <div className="counter">{this.state.excerpt.length} / 150</div>
          </div>
          <div id="read-more-row">
            <label htmlFor="input-read-more">"Read More" Link</label>
            {linkInput}
          </div>

        </div>
        <div className="right-side">
          <div id="image-row">
          <label>Article Image</label>
          <div className={"img-container "+thumbState} onClick={this.thumbClick}>
            {thumb}
            {imgHelper}
          </div>
          <a href="#" style={{visibility: removeThumb}} className="remover" onClick={this.removeThumb}>Remove </a>
          </div>
        </div>
        <br className="clear" />
       </div>
    )
  }
});
