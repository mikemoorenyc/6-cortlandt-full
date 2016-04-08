var MapPoint = React.createClass({
  pointClicked: function(e) {
    e.preventDefault();
    e.stopPropagation();
    console.log('point clicked');
  },
  render: function(){

    return (
      <div className="map-point"
        style={{
          left: (this.props.pointcoor.l * 100)+'%',
          top: (this.props.pointcoor.t * 100)+'%',
        }}
        onClick={this.pointClicked}
      >


      </div>
    )
  }
});
