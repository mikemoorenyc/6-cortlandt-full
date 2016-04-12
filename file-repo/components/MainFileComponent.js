var MainFileComponent = React.createClass({
  getInitialState: function(){
    return {
      file: {}
    }
  },
  render: function(){
    return(
      <div >
      <FileForm file={this.state.file} />
      </div>
    )
  }
});
