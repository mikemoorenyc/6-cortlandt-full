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
       zoom: 1.6,
       overlayPos: {
         weightX:.5,
         weightY: .5,
         x: 0,
         y: 0
       },
       pointcoor: coordinates,
       dragging:false,
       mousePos: {}
     }
   },
   getWindowSize: function() {
     var height = $(this.refs.mapWindow).width() * this.state.aspect
     this.setState({
       windowDim: {
         width: $(this.refs.mapWindow).width(),
         height: height
       },
       overlayPos: {
         x: ($(this.refs.mapWindow).width() - ($(this.refs.mapWindow).width()*this.state.zoom)) /2,
         y: (height- (height*this.state.zoom)) /2
       }
     })
   },
   componentDidMount: function() {
     $(window).on('resize',function(){
       this.getWindowSize();
       this.setState({
         zoom:1
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
     e.preventDefault()
     if(!this.state.dragging) {
       return false;
     }
     this.positionFinder(e.pageX,e.pageY, this.state.mousePos.x, this.state.mousePos.y)

     this.setState({
       mousePos: {
         x: e.pageX,
         y: e.pageY
       }
     })


   },
   positionFinder: function(nX,nY,pX,pY) {

     var  oX = parseFloat($(this.refs.mapOverlay).css('left')),
          oy = parseFloat($(this.refs.mapOverlay).css('top')),
          oW = $(this.refs.mapOverlay).width(),
          oH = $(this.refs.mapOverlay).height(),
          xThresh = ($(this.refs.mapWindow).width() - oW) ;
     var xDif = nX - pX,
          yDif = nY - pY;
          console.log(oX);
          console.log(xThresh);
      var newX = xDif + this.state.overlayPos.x;
      if(newX < 0 && newX > (xThresh)) {
        console.log('move')
        this.setState({
          overlayPos: {
            weightY: this.state.overlayPos.weightY,
            weightX: (-xDif*.001) + this.state.overlayPos.weightX,
            x: newX
          }
        });

      } else {

      }
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
      left: this.state.overlayPos.x+'px',
      top: this.state.overlayPos.y+'px'
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
          onMouseLeave={this.mUp}
          onMouseMove={this.mMove}
          style={mapDim}
          ref="mapOverlay"
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
