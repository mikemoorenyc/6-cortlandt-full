var MapPoint = React.createClass({
  getInitialState: function() {
    return {
      pointCoor: this.props.pointcoor,
      dragObj: {}
    }
  },
  componentDidMount: function(){
    var $draggable = $(this.refs.point).draggabilly({
  // options...
    });
    
    $draggable.on( 'dragEnd', function( event, pointer ) {
      this.props.pointUpdate(pointer.pageX,pointer.pageY);
    }.bind(this));
  },
  componentWillUnmount: function() {
    $draggable.off( 'dragEnd');
    $draggable.draggabilly('destroy');
  },
  render: function(){

    return (
      <div ref="point" className="map-point"

        style={{
          left: (this.props.pointcoor.l * 100)+'%',
          top: (this.props.pointcoor.t * 100)+'%',
        }}
      >


      </div>
    )
  }
});
