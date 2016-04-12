var MainFileComponent = React.createClass({
  getInitialState: function(){
    return {
      file: {
        state: 'empty'
      }
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
