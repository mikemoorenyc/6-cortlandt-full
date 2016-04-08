 var MapWindow = React.createClass({
   getInitialState: function() {
     return {
       windowDim: {
         left:0,
         top:0,
         width:0,
         height:0
       },
       imgDim: {
         left:0,
         top:0,
         width:0,
         height:0
       },
       pointcoor: this.props.pointCoor
     }
   },
   getWindowSize: function() {
     this.setState({
       windowDim: {
         width: $(this.refs.mapWindow).width(),
         height: $(this.refs.mapWindow).height(),
         left: $(this.refs.mapWindow).offset().left,
         top: $(this.refs.mapWindow).offset().top
       },
       imgDim: {
         width: $(this.refs.mapImage).width(),
         height: $(this.refs.mapImage).height(),
         left: $(this.refs.mapImage).offset().left,
         top: $(this.refs.mapImage).offset().top
       }
     })
   },
   componentDidMount: function() {
     $(window).on('resize',function(){
       this.getWindowSize();
     }.bind(this));
     this.getWindowSize();
   },
   componentWillUnmount: function() {
     $(window).off('resize');
   },
   overlayClicked: function(e) {
     e.preventDefault();
     this.pointcoorUpdate(e.pageX,e.pageY);
   },
   pointcoorUpdate: function(x,y) {
     this.setState({
       pointcoor: {
         l: x,
         t: y
       }
     });
     this.props.updateCoor({x:x,y:y});
   },
   zoomIncrease: function() {
     this.setState({zoom:2});
   },
  render: function() {
    return (
      <div className="map-window" ref="mapWindow"
      style={{
        paddingTop: ((INITIALH/INITIALW)*100)+'%'
      }}
      >
        <img className="map-image"


        ref="mapImage" src={IMGSRC} />
        <div className="map-overlay"

          style={{
            width: this.state.imgDim.width,
            height: this.state.imgDim.height,
            left: this.state.imgDim.left - this.state.windowDim.left,
            top: this.state.imgDim.top - this.state.windowDim.top
          }}
        >
        <MapPoint
        overlayDim={{width:this.state.imgDim.width,height:this.state.imgDim.height}}
        pointcoor={this.state.pointcoor}
        pointUpdate={this.pointcoorUpdate}

        />


        </div>
        <div className="zoom-increase" onClick={this.zoomIncrease}>Increase</div>

      </div>
    )
  }
});
