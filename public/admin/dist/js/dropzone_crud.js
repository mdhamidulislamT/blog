
        $(function() {
            //Initialize Select2 Elements
            var dropzone_url = $('#dropzone_url').val();
            var _token = $('input[name="_token"]').val();
            // DropzoneJS Demo Code Start
            Dropzone.autoDiscover = false

            // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
            var previewNode = document.querySelector("#template")
            previewNode.id = ""
            var previewTemplate = previewNode.parentNode.innerHTML
            previewNode.parentNode.removeChild(previewNode)

            var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                paramName: "file",
                url: dropzone_url,
                //addRemoveLink : true,
                //autoProcessQueue : false,
                //uploadMultiple : false,
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 1,
                maxFile: 1,
                //addRemoveLinks: true,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                previewTemplate: previewTemplate,
                previewsContainer: "#previews", // Define the container to display the previews
                clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
                params: {
                    _token: _token
                },

                init: function() {
                    var myDropzone = this;
                    /* this.on('sending', function(file, xhr, formData) {
                    }); */
                    this.on('success', function(file, response) {
                        //console.log("upload success");
                    });
                    this.on('queuecomplete', function() {
                        //console.log("queuecomplete queuecomplete");
                    });
                   /*  this.on('sendingmultiple', function() {
                        console.log("sendingmultiple sendingmultiple");
                    }); */
                    /* this.on('successmultiple', function(files, response) {
                        console.log("successmultiple successmultiple");
                    }); */
                   /*  this.on('errormultiple', function(files, response) {
                        console.log("errormultiple errormultiple");
                    }); */
                    this.on('removedfile', function(file) {
                        //console.log("removed file");
                        //console.log(file);
                    });
                }
            })
            myDropzone.on("addedfile", function(file) {
                // Hookup the start button
                /* file.previewElement.querySelector(".start").onclick = function() {
                    myDropzone.enqueueFile(file)
                    console.log("actions  single start");
                } */
            })
  
            document.querySelector("#actions .cancel").onclick = function(e) {
                myDropzone.removeAllFiles(true);
                // we may use here Ajax Calling To Perform Something
                //console.log("Cancel All Uploads");
            }
        })

        function removeImage(id, imgNum) {
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel!",
                reverseButtons: !0
            }).then(function(e) {
                if (e.isConfirmed) {
                    $('#image_' + imgNum).remove();
                }
            });
        }
 