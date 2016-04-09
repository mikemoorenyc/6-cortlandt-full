 var MapWindow = React.createClass({

   getInitialState: function() {
     var coordinates = this.props.pointCoor;
     if(!coordinates) {
       coordinates = {
         x: .5,
         y: .5
       }
     }
     return {
       aspect: INITIALH/INITIALW,
       windowDim: {
         width:0,
         height:0
       },
       zoom: 1,
       overlayPos: {
         weightX:.5,
         weightY: .5,
         left: 0,
         top: 0
       },
       pointcoor: coordinates,
       dragging:false,
       mousePos: {}
     }
   },
   getWindowSize: function() {
     this.setState({
       windowDim: {
         width: $(this.refs.mapWindow).width(),
         height: $(this.refs.mapWindow).width() * this.state.aspect
       }
     })
   },
   componentDidMount: function() {
     $(window).on('resize',function(){
       this.getWindowSize();
       this.setState({
         zoom:1,
         overlayPos: {
           weightX:.5,
           weightY: .5,
           left: 0,
           top: 0
         }
       })
     }.bind(this));
     this.getWindowSize();
   },
   componentWillUnmount: function() {
     $(window).off('resize');
   },
   pointcoorUpdate: function(x,y) {
     this.setState({
       pointcoor: {
         x: x,
         y: y
       }
     });
     this.props.updateCoor({x:x,y:y});
   },
   zoomIncrease: function() {
     this.setState({zoom:this.state.zoom+.2});
   },
   zoomDecrease: function() {
     this.setState({zoom:this.state.zoom-.2});
   },
   mDown: function(e) {
     e.stopPropagation();
     this.setState({
       dragging:true,
       mousePos: {
         x: e.pageX,
         y: e.pageY
       }
     })
   },
   mUp: function(e) {
     this.setState({dragging:false})
   },
   mMove: function(e) {
     if(!this.state.dragging) {
       return false;
     }
     this.positionFinder(e);

     this.setState({
       mousePos: {
         x: e.pageX,
         y: e.pageY
       }
     })


   },
   positionFinder: function(event) {
     var xDif = event.clientX - this.state.mousePos.x,
          yDif = event.clientY - this.state.mousePos.y,
          newPosX = imgX + xDif,
          newPosY = imgY + yDif;
   },
  render: function() {

    var zoomin,
        zoomout;
    if(this.state.zoom <=2) {
      zoomin= <div className="zoom-increase" onClick={this.zoomIncrease}>Increase</div>

    }
    if(this.state.zoom >1) {
      zoomout=<div className="zoom-decrease" onClick={this.zoomDecrease}>Decrease</div>
    }
    var xDif = ((this.state.windowDim.width * this.state.zoom) - this.state.windowDim.width);
    var yDif = ((this.state.windowDim.height* this.state.zoom) - this.state.windowDim.height);
    var mapDim = {
      width: this.state.windowDim.width * this.state.zoom,
      height: this.state.windowDim.height * this.state.zoom,
      left: -(xDif*this.state.overlayPos.x)+'px',
      top: -(yDif*this.state.overlayPos.y)+'px'
    }
    return (
      <div className="map-window" ref="mapWindow"
      style={{
        paddingTop: ((INITIALH/INITIALW)*100)+'%'
      }}
      >
        <img className="map-image"
        style={mapDim}

        ref="mapImage" src={IMGSRC} />
        <div className="map-overlay"
          onMouseDown={this.mDown}
          onMouseUp={this.mUp}
          onMouseMove={this.mMove}
          style={mapDim}
        >
        <MapPoint
        overlayDim={mapDim}
        pointcoor={this.state.pointcoor}
        pointUpdate={this.pointcoorUpdate}

        />


        </div>

        <div className="zoom-controls">
          {zoomin}
          {zoomout}
        </div>


      </div>
    )
  }
});
