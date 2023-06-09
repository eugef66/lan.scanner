
// -----------------------------------------------------------------------------
function showModalDefault (title, message, btnCancel, btnOK, callbackFunction) {
	// set captions
	$('#modal-default-title').html   (title);
	$('#modal-default-message').html (message);
	$('#modal-default-cancel').html  (btnCancel);
	$('#modal-default-OK').html      (btnOK);
	modalCallbackFunction =          callbackFunction;
  
	// Show modal
	$('#modal-default').modal('show');
  }
  
  // -----------------------------------------------------------------------------
  function showModalDanger (title, message, btnCancel, btnOK, callbackFunction) {
	// set captions
	$('#modal-danger-title').html   (title);
	$('#modal-danger-message').html (message);
	$('#modal-danger-cancel').html  (btnCancel);
	$('#modal-danger-OK').html      (btnOK);
	modalCallbackFunction =          callbackFunction;
  
	// Show modal
	$('#modal-danger').modal('show');
  }
  
  // -----------------------------------------------------------------------------
  function modalDefaultOK () {
	// Hide modal
	$('#modal-default').modal('hide');
  
	// timer to execute function
	window.setTimeout( function() {
	  window[modalCallbackFunction]();
	}, 100);
  }
  
  // -----------------------------------------------------------------------------
  function modalDangerOK () {
	// Hide modal
	$('#modal-danger').modal('hide');
  
	// timer to execute function
	window.setTimeout( function() {
	  window[modalCallbackFunction]();
	}, 100);
  }
  
  // -----------------------------------------------------------------------------
  function showMessage (textMessage="") {
	if (textMessage.toLowerCase().includes("error")  ) {
	  // show error
	  alert (textMessage);
	} else {
	  // show temporal notification
	  $("#alert-message").html (textMessage);
	  $("#notification").fadeIn(1, function () {
		window.setTimeout( function() {
		  $("#notification").fadeOut(500)
		}, 3000);
	  } );
	}
  }
  