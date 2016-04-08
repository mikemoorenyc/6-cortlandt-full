 var MapWindow = React.createClass({
   getInitialState: function() {
     var pointcoor = this.props.pointcoor;
     if(!this.props.pointcoor) {
       var pointcoor = {
         l: .5,
         t: .5
       }
     }
     return {
       windowDim: {},
       imgDim: {},
       pointcoor: pointcoor
     }
   },
   getWindowSize: function() {
     this.setState({
       windowDim: this.refs.mapWindow.getBoundingClientRect(),
       imgDim: this.refs.mapImage.getBoundingClientRect()
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

     var boxTop = this.state.imgDim.top+$(window).scrollTop();
     console.log(e.pageY);

     this.setState({
       pointcoor: {
         l: (e.pageX - this.state.imgDim.left) / this.state.imgDim.width,
         t: (e.pageY - (boxTop)) / this.state.imgDim.height
       }
     })


   },
  render: function() {
    return (
      <div className="map-window" ref="mapWindow"
      style={{
        paddingTop: ((INITIALH/INITIALW)*100)+'%'
      }}
      >
        <img className="map-image" ref="mapImage" src={IMGSRC} />
        <div className="map-overlay"
          onClick={this.overlayClicked}
          style={{
            width: this.state.imgDim.width,
            height: this.state.imgDim.height,
            left: this.state.imgDim.left - this.state.windowDim.left,
            top: this.state.imgDim.top - this.state.windowDim.top
          }}
        >
        <MapPoint
        pointcoor={this.state.pointcoor}


        />


        </div>

      </div>
    )
  }
});
