var FileForm = React.createClass({

  formClick: function(e) {
    e.preventDefault();
    $(this.refs.fileinput).click();
  },
  fileChanged: function(e) {
      if(!e.target) {
        return false;
      }

        this.props.setFile({
          state: 'processing'
        });
        var file = e.target.files[0] || e.dataTransfer.files[0];

        var formData = new FormData();
        formData.append('file', file, file.name);
        formData.append('id', APP.fileID);

        var xhr = new XMLHttpRequest();

        xhr.open('POST', APP.siteDir+'/file-repo/file-uploader.php', true);
        xhr.onload = function (data) {
          if (xhr.status === 200) {
            var fileData = jQuery.parseJSON(data.srcElement.responseText);
            this.props.setFile({
              state: 'uploaded',
              filename: fileData.filename,
              color: fileData.color,
              id: fileData.id
            });

          } else {
            //ERROR STATE
            $(this.refs.fileinput).val('');
            this.props.setFile({
              state: 'error'
            });

          }
        }.bind(this);


        xhr.send(formData);



  },
  render: function(){
    var headline,
        iconColor,
        iconState = 'media-text',
        interiorCopy,
        buttonText,
        progressBar,
        buttonState ='button-large';
    if(this.props.file.state == 'empty') {
      headline = 'Upload a File';
      iconColor = '#efefef';
      interiorCopy = 'Choose a file for investors to download.<br/>Accepted formats: .jpg, .png, .pdf, .doc, .ppt, .xls';
      buttonText = 'Choose a file';
      buttonState = "button-hero"
    }
    if(this.props.file.state == 'error') {
      headline = 'File not uploaded';
      iconColor = 'transparent';
      interiorCopy = 'There was a problem uploading your file. ';
      buttonText = 'Try again';
      iconState = 'warning';
    }
    if(this.props.file.state == 'processing') {
      headline = "Processing..."
      iconColor = '#efefef';
      interiorCopy = 'Your file is being uploaded to our servers.';
      progressBar = <div className="progress-bar"></div>;
    }
    if(this.props.file.state == 'uploaded') {
      headline = 'File Uploaded';
      iconColor = this.props.file.color;
      interiorCopy = this.props.file.filename;
      buttonText = 'Change the file';
    }
    return (
      <div className={"file-form box-styler state-"+this.props.file.state}>
        <input type="file"
        ref="fileinput"
        style={{display:'none'}}
        onChange={this.fileChanged}
        />
        <div className={"icon state-"+this.props.file.state} style={{backgroundColor: iconColor}}>
          <span className={"dashicons dashicons-"+iconState}></span>
        </div>
        <div className="copy">
          <h1>{headline}</h1>
          <p className="sm-copy" dangerouslySetInnerHTML={{__html: interiorCopy}}></p>
          <button onClick={this.formClick} className={"button button-primary "+buttonState} >{buttonText}</button>
          {progressBar}
        </div>
      </div>
    )
  }
});
