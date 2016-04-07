var MainMapComponent = React.createClass({
  getInitialState: function() {
      return {
        points: INITIALPOINTS,
        width: INITIALW,
        height:INITIALH,
        imgSrc: IMGSRC,
        aspect: INITIALH / INITIALW,
        zoom: 1,
        dragging: false,
        mousedown: false
      }
  },
  wheelMove: function(e) {
    e.preventDefault();
    console.log('asfddsf');
    console.log(e.deltaY);
  },
  draggerStart: function() {
    this.setState({mousedown:true});
    setTimeout(function(){
      if(this.state.mousedown == true) {
        this.setState({dragging: true})
      }
    }.bind(this),500)
  },
  draggerEnd: function() {
    var dragState = this.state.dragging;
    this.setState({mousedown:false, dragging:false});
  },
  render: function() {

    return(
      <div id="map-window"
          onMouseDown={this.draggerStart}
          onMouseUp={this.draggerEnd}
          style={{
            paddingTop: (this.state.aspect*100)+'%'
          }}
            >
        <input type="hidden" value={this.state.points} name="map_points" id="map_points" />
        <MapImage img={this.state.imgSrc} zoom={this.state.zoom} />


      </div>
    )
  }






});
