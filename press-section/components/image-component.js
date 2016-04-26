var ArticleComponent = React.createClass({


  render: function() {
    var imgState = 'filled',
        thumbnail = <img src={this.props.imgURL} />;

    if(this.props.imgID) {
      imgState = 'empty';
      thumbnail = false;
    }
    return (
      <div
      data-state={imgState}
      id="image-row">
        <label>Article Image</label>
        <div className={"img-container "+imgState} onClick={this.thumbClick}>
          {thumbnail}
          <div className="helper">
            <span className="dashicons dashicons-format-image"></span>
            <button className="button button-primary button-small">Add an image</button>
          </div>
        </div>

      </div>
    )
  }
});
