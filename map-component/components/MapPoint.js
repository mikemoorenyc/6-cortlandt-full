var MapPoint = React.createClass({
  getInitialState: function() {
    return {
      pointCoor: this.props.pointcoor
    }
  },
  componentDidMount: function(){
    this.setState()
    APP.dragger = $(this.refs.point).draggabilly({
      containment:true
    });
    APP.dragger.on( 'dragEnd', function( event, pointer ) {
      var dragData = $(APP.dragger).data('draggabilly');
      //console.log(dragData)
      //console.log(this.props.pointcoor.x);
      //console.log(dragData.dragPoint.x /this.props.overlayDim.width + this.props.pointcoor.x);
      var xChange = (dragData.dragPoint.x / this.props.overlayDim.width)+this.props.pointcoor.x;
      var yChange = (dragData.dragPoint.y / this.props.overlayDim.height)+this.props.pointcoor.y;
      this.props.pointUpdate(xChange,yChange);
    }.bind(this));
  },
  componentWillUnmount: function() {
    APP.dragger.off( 'dragEnd');
    APP.dragger.draggabilly('destroy');
  },
  stopProp: function(e) {
    e.stopPropagation();
  },
  render: function(){
    return (
      <div ref="point" className="map-point"
        onMouseDown={this.stopProp}
        style={{
          left: (this.props.pointcoor.x * 100)+'%',
          top: (this.props.pointcoor.y * 100)+'%',
        }}
      >


      </div>
    )
  }
});
