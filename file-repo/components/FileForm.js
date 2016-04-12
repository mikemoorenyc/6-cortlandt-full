var FileForm = React.createClass({


  render: function(){
    var headline,
        iconColor,
        iconState = 'media-text',
        interiorCopy,
        buttonText,
        progressBar;
    if(this.props.file.state == 'empty') {
      headline = 'Upload a File';
      iconColor = '#efefef';
      interiorCopy = 'Choose a file for investors to download.<br/>Accepted formats: .jpg, .png, .pdf, .doc, .ppt, .xls';
      buttonText = 'Choose a file';
    }
    return (
      <div className={'file-form '+this.props.state}>
        <div className="icon" style={{backgroundColor: iconColor}}>
          <span className={"dashicons dashicons-"+iconState}></span>
        </div>
        <div className="copy">
          <h1>{headline}</h1>
          <p className="sm-copy" dangerouslySetInnerHTML={{__html: interiorCopy}}></p>
          <button className="button button-primary">{buttonText}</button>
        </div>
      </div>
    )
  }
});
