var UserList = React.createClass({

  checkboxClicked: function(e) {
    e.preventDefault(e);
    this.props.checkToggle(e.target.value);
  },
  render: function() {
    var userArray = this.props.userList;

    userArray.sort(function(a, b) {
    var textA = a.lastName.toUpperCase();
    var textB = b.lastName.toUpperCase();
    return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
    });
    var userBlock = userArray.map(function(user){
      var displayName,
          inGroup,
          selected = '',
          checkState = '',
          checkBox,
          userChecked = false,
          checkDisabled = false;
      //SET UP DISPLAY NAME
      if(!user.firstName) {
        displayName = user.lastName;
      } else {
        displayName = user.lastName+', '+user.firstName;
      }

      //IF IN GROUP
      var groups = user.groups;
      $(groups).each(function(index, e){
        if(jQuery.inArray( parseFloat(e),this.props.selectedGroups ) > -1) {
          inGroup = <span className="group-span">in selected group</span>;
          checkState = 'disabled';
          checkDisabled = true;
        }
      }.bind(this));

      //IF SELECTED
      if(inGroup || jQuery.inArray( parseFloat(user.id),this.props.selectedUsers ) > -1) {
        selected = 'selected';
      }

      //IF
      if(jQuery.inArray( parseFloat(user.id),this.props.selectedUsers ) > -1) {
        userChecked = true;
      }

      return (
        <div className={"user "+checkState+' '+selected} key={user.id}>
          <input style={{display:'none'}} type="checkbox" value={user.id} id={'input-user-'+user.id} data-checked={userChecked} disabled={checkDisabled} onChange={this.checkboxClicked}  />

          <label htmlFor={'input-user-'+user.id}>
            <span className="checkbox" data-checked={userChecked}>
              <span className="dashicons dashicons-yes"></span>
            </span>
            {displayName} {inGroup}
          </label>
        </div>
      );
    }.bind(this));
    return (
      <div className="user-list box-styler">
        <div>
        {userBlock}
        </div>
      </div>
    )
  }
});
