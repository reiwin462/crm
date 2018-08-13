function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        swal({
            type: "error",
            title: "validation",
            text: "Please enter number values only"
        });
        return false;
    } else {
        return true;
    }
}

function newdropdown(fld) {
    var xlink = window.location.host;
    var newdata
    swal({
        title: "Please Enter Your Item for <br>" + fld.replace("_", " "),
        input: "text",
        inputAttributes: {
            autocapitalize: "off",
            id: "newdropdownitem"
        },
        showCancelButton: true,
        confirmButtonText: "Insert",
        showLoaderOnConfirm: true,
        preConfirm: (xitem) => {
            var link = "'. base_url() .'process/newitem/" + fld + "/" + $("#newdropdownitem").val();
            newdata = $("#newdropdownitem").val();
            return fetch(link)
                .then(response => {
                    if (response == "success") {
                        $("#" + fld).append($("<option>", {
                            value: newdata,
                            text: newdata,
                        }));
                        swal({
                            type: "success",
                            title: "success",
                            text: response
                        })
                    } else {
                        swal({
                            type: "error",
                            title: "error",
                            text: response
                        })
                    }
                })
                .catch(error => {
                    swal.showValidationError(
                        "Request failed: ${error}"
                    )
                })
        },
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (result.value) {
            swal({
                type: "success",
                title: "success",
                text: ""
            })
            $("#" + fld).append($("<option>", {
                value: newdata,
                text: newdata,
            }));
        }
    });
}

function colorvalidate(obj){
	var item = obj.attr('id');
	if(obj.val() == ""){
		 obj.toggleClass('isempty');
	}else{
		obj.toggleClass('ispass');
	}
	console.log(obj.val());
}
