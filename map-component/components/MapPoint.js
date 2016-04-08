var MapPoint = React.createClass({
  getInitialState: function() {
    return {
      pointCoor: this.props.pointcoor
    }
  },
  componentDidMount: function(){
    APP.dragger = $(this.refs.point).draggabilly({
      containment:true
    });
    APP.dragger.on( 'dragEnd', function( event, pointer ) {
      var dragData = $(APP.dragger).data('draggabilly');
      var xChange = (dragData.dragPoint.x / this.props.overlayDim.width)+this.props.pointcoor.x;
      var yChange = (dragData.dragPoint.y / this.props.overlayDim.height)+this.props.pointcoor.y;
      this.props.pointUpdate(xChange,yChange);
    }.bind(this));
  },
  componentWillUnmount: function() {
    APP.dragger.off( 'dragEnd');
    APP.dragger.draggabilly('destroy');
  },
  render: function(){

    return (
      <div ref="point" className="map-point"

        style={{
          left: (this.props.pointcoor.x * 100)+'%',
          top: (this.props.pointcoor.y * 100)+'%',
        }}
      >


      </div>
    )
  }
});
