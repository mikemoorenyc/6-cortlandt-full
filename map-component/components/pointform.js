var PointForm = React.createClass({
  getCatName: function(value) {
    var catName = '';
    $(this.props.categories).each(function(index,e){
      var cat = e;
      if(value ==e.id) {

        catName =  e.name;
      }
    }.bind(this));
    return catName;
  },
  getCatColor: function(value) {
    var catName = '';
    $(this.props.categories).each(function(index,e){
      var cat = e;
      if(value ==e.id) {

        catName =  e.color;
      }
    }.bind(this));
    return catName;
  },
  getInitialState: function() {

//. console.log(this.props.coor);
    return {
      title: this.props.title,
      cat: this.props.cat,
      coor: this.props.coor,
      catName: this.getCatName(this.props.cat)
    }
  },

  cancelClick: function(e) {
    e.preventDefault();

    if(this.props.newPoint) {
      this.props.deletePoint(this.props.id);
    } else {
      this.props.savePoint({
        id: this.props.id,
        title: this.props.title,
        cat: this.props.cat,
        coor: this.props.coor,
        editing: false
      });
    }
  },
  deleteClick: function(e) {
    e.preventDefault();
    this.props.deletePoint(this.props.id,true);
  },
  updateTitle: function(e) {
      this.setState({title: e.target.value});
  },
  updateCat: function(e) {
    this.setState({cat: e.target.value, catName: this.getCatName(e.target.value)});
  },
  updateCoor: function(coor) {

    this.setState({coor:coor})
  },
  publishClick: function(e) {

    e.preventDefault();
    this.props.savePoint({
      id: this.props.id,
      title: this.state.title,
      cat: this.state.cat,
      coor:this.state.coor,
      editing: false,
      newCat: false
    });
  },
  render: function() {
    var disabled = true;
    var deleter = false;
    if(this.state.title) {
      disabled = false;
    }

    var publishCopy = 'Save';
    if(!this.props.newPoint) {
      publishCopy = 'Update';
      deleter = <a href="#" className="delete" onClick={this.deleteClick}>Delete</a>;
    }

  //  console.log(this.props.coor);
    return (
      <div className="point-form">
        <div className="point-form-header clearfix">

            <input type="text"  placeholder="Point Name" value={this.state.title} onChange={this.updateTitle}/>


          <select defaultValue={this.state.cat} onChange={this.updateCat}>
          {
            this.props.categories.map(function (cat) {
              return (
                <option value={cat.id} key={cat.id} dangerouslySetInnerHTML={{__html:cat.name}}></option>
              )
            })
          }
          </select>
          <br className="clear" />

        </div>
        <MapWindow
        updateCoor={this.updateCoor}
        pointCoor ={this.state.coor}
        />
        <div className="FormFooter">
          {deleter}
          <button className="cancel-button button button-secondary " onClick={this.cancelClick}>Cancel</button>
          <button className="publish-button button button-primary " onClick={this.publishClick} disabled={disabled}>{publishCopy}</button>
        </div>

      </div>
    )

  }
});
