var FileForm = React.createClass({

  formClick: function(e) {
    e.preventDefault();
    $(this.refs.fileinput).click();
  },
  fileChanged: function(e) {

        var file = e.target.files[0] || e.dataTransfer.files[0];
        //console.log(file.name);
        var theFile = new FormData();
      //  theFile.append('file', file);
        theFile.append('id', 1);
        theFile.append('name', file.name);
        console.log(theFile);

        jQuery.ajax({
         url: APP.siteDir+'/file-repo/file-uploader.php',
         data: theFile,
         async: true,
         type: "POST",
                    success: function(data) {console.log(data) }
        });
        

  },
  render: function(){
    var headline,
        iconColor,
        iconState = 'media-text',
        interiorCopy,
        buttonText,
        progressBar,
        buttonState;
    if(this.props.file.state == 'empty') {
      headline = 'Upload a File';
      iconColor = '#efefef';
      interiorCopy = 'Choose a file for investors to download.<br/>Accepted formats: .jpg, .png, .pdf, .doc, .ppt, .xls';
      buttonText = 'Choose a file';
      buttonState = "button-hero"
    }
    return (
      <div className={'file-form '+this.props.file.state}>
        <input type="file"
        ref="fileinput"
        style={{display:'none'}}
        onChange={this.fileChanged}
        />
        <div className="icon" style={{backgroundColor: iconColor}}>
          <span className={"dashicons dashicons-"+iconState}></span>
        </div>
        <div className="copy">
          <h1>{headline}</h1>
          <p className="sm-copy" dangerouslySetInnerHTML={{__html: interiorCopy}}></p>
          <button onClick={this.formClick} className={"button button-primary "+buttonState} >{buttonText}</button>
        </div>
      </div>
    )
  }
});
