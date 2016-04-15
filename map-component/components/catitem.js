var CatItem = React.createClass({
  getInitialState: function() {
    return {
      hovering: false
    }
  },

  deleteClick: function() {
    this.props.deleteCat(this.props.id, true);
  },
  editClick: function() {
    this.props.saveCat({
      id:this.props.id,
      name: this.props.name,
      color: this.props.color,
      editing:true
    })
  },

  entering: function(state) {
    this.setState({hovering:true})
  },
  leaving: function() {
    this.setState({hovering:false})
  },
  render: function() {

    var handle = <div className="drag-handle" data-hover={this.state.hovering}>
                    <div className="icon">
                      <span></span>
                    </div>
                  </div>;
    if(this.props.canDrag == false) {
      handle = false;
    }

    return (
      <div className="category-item" onMouseEnter={this.entering} onMouseLeave={this.leaving}>
      <div className="category-title">{this.props.name}</div>
      {handle}
      <button onClick={this.editClick} className="edit-bubble" style={{backgroundColor: this.props.color}}>
        <span className="icon" data-hover={this.state.hovering} dangerouslySetInnerHTML={{__html:PENICON}}>

        </span>

      </button>


      </div>
    )
  }
});
