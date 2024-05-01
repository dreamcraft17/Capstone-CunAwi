@extends('layouts.sidenav')

@section('head')
{{-- style, script, manggil library script cdn --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="argon/assets/css/argon-dashboard.css">
<link rel="stylesheet" href="argon/assets/css/font-awesome.min.css">

<style>
    .preview-image {
        max-width: 100px;
        max-height: 100px;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .remarks-container {
        border: 2px solid #cbcbcb;
        border-radius: 2px;
        padding: 10px;
    }
</style>
@endsection

@section('content')
@include('layouts.topnav', ['title' => 'New Project'])

{{-- Di sini baru ngoding, buatla apa gitu --}}
<div class="container">

    <div class="card overflow-hidden">
        <div class="bg-soft">
            <div class="row">
                <div class="col m-4">
                    <h2 style="color: black; text-align: center;"> New Project Form </h2>
                </div>
            </div>
        </div>
    </div>

    <fieldset>
        <form action="{{ route('storeNewProject') }}" method="POST">
            @csrf
            <div class="row">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="row">
                                    
                                    <div class="col">
                                        <label>Product ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="productID" name="productID" placeholder="Click Here to Enter" />
                                    </div>

                                    <div class="col">
                                        <label>Toy Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="toyName" placeholder="Click Here to Enter" name="toyName">
                                    </div>

                                    <div class="col">
                                        <label>Product Engineering<span class="text-danger">*</span></label>
                                        <select id="pe" class="form-control" name="pe">
                                            <option selected> -- Select Here -- </option>
                                            <option value="Emily Jhonson">Emily Johnson</option>
                                            <option value="Jessica Lee">Jessica Lee</option>
                                            <option value="Ryan Johnson">Ryan Johnson</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label>Product Design<span class="text-danger">*</span></label>
                                        <select id="designer" class="form-control" name="designer">
                                            <option selected> -- Select Here -- </option>
                                            <option value="Sarah Davis">Sarah Davis</option>
                                            <option value="Dnaiel Kim">Daniel Kim</option>
                                            <option value="Ethan Chen">Ethan Chen</option>
                                        </select>
                                    </div>


                                </div>

                                <div class="row g-2 mt-4">
                                    <div class="col-sm-12">
                                        <div id="queuedImages" class="queued-div p-2">
                                            <div id="imagePreviewContainer" class="d-flex flex-wrap mr-3"></div>
                                        </div>
                                        <div id="id-input-div" class="mt-2">
                                            <label class="text-dark text-bold">Insert Picture(s) <span class="text-danger">*</span></label>
                                            <label>Drag & drop photos here or click to browse</label>
                                            <input name="images" id="input_image" type="file" class="form-control" accept="image/jpeg, image/png, image/jpg" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col">
                                        <label>Category Material <span class="text-danger">*</span></label>
                                        <select id="category" class="form-control" name="category">
                                            <option selected> -- Select Here -- </option>
                                            <option value="Plastic">Plastic</option>
                                            <option value="Rubber">Rubber</option>
                                            <option value="Metal">Metal</option>
                                            <option value="Plastic, Rubber">Plastic, Rubber</option>
                                            <option value="Plastic, Metal">Plastic, Metal</option>
                                            <option value="Rubber, Metal">Rubber, Metal</option>
                                            <option value="Plastic, Rubber, Metal">Plastic, Rubber, Metal</option>
                                            <option value="Cardboard">Cardboard</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label>Product Description <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="description" placeholder="Enter Description" name="description">
                                    </div>
                                </div>

                                <div class="container mt-4">
                                    <div class="row">
                                        <div class="col">
                                            <br />
                                            <p class="text-dark mt-2">Meeting Date</p>
                                        </div>
                                        <div class="col">
                                            <label>Date</label>
                                            <input type="date" class="form-control" id="meeting" name="meeting" />
                                        </div>
                                        <div class="col">
                                            <label>Day</label>
                                            <input type="text" class="form-control" id="koday" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="container mt-4">
                                    <div class="row">
                                        <div class="col">
                                            <br />
                                            <p class="text-dark mt-2">Start Date</p>
                                        </div>
                                        <div class="col">
                                            <label>Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" />
                                        </div>
                                        <div class="col">
                                            <label>Day</label>
                                            <input type="text" class="form-control" id="startday" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="container mt-4">
                                    <div class="row">
                                        <div class="col">
                                            <br />
                                            <p class="text-dark mt-2">Finish Date (CMT)</p>
                                        </div>
                                        <div class="col">
                                            <label>Date</label>
                                            <input type="date" class="form-control" id="finish_cmt" name="finish_cmt" readonly />
                                        </div>
                                        <div class="col">
                                            <label>Day</label>
                                            <input type="text" class="form-control" id="finishday" readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control" id="remarks" placeholder="Enter Remarks" name="remarks">
                                </div>

                                <div style="text-align: right;" class="mt-4">
                                    <input type="button" id="saveDraftButton" class="btn btn-secondary rubik-font" value="Draft" />
                                    <input type="button" id="nextButton" class=" btn btn-danger rubik-font" value="Next Step" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </fieldset>

    <fieldset style="display: none;">
        <!-- Add your form fields here -->s
        <div class="row">
            <div class="card mt-4">

                <div class="text-center mt-4">
                    <span class="text-bold ml-2 mr-2" style="font-size: 24px;">
                        <a style="text-align: center;">
                            <h1 id="displayProjectName"></h1>
                        </a>
                    </span>
                </div>

                <div class="row p-4">
                    <div class="col">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Image slideshow -->
                                    <div style="padding:10px; position: relative;">
                                        <div class="slide-content" style="max-width: 850px; text-align: center;">
                                            <div id="slideshow-container fade">
                                                <div class="image-container">
                                                    <img id="uploadedImage" class="mySlides img-fluid border-radius-md" width="300" src="https://cdn3d.iconscout.com/3d/premium/thumb/no-photo-5590994-4652997.png" style="display:block;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Content catalog -->
                                    <div class="content-catalog">
                                        <hr />
                                        <!-- Add more content here -->
                                        <div class="row">
                                            <div class="col rubik-font">
                                                <a style="text-align: left;">
                                                    <h6 style="opacity: 0.8;">PRODUCT ID</h6>
                                                    <p id="displayProductID"></p>

                                                    <h6 style="opacity: 0.8;">PRODUCT DESCRIPTION</h6>
                                                    <p id="displayProductDescription"></p>
                                                </a>
                                            </div>

                                            <div class="col rubik-font">
                                                <a style="text-align: left;">

                                                    

                                                    <h6 style="opacity: 0.8;">PRODUCT ENGINEER</h6>
                                                    <p id="displayProductEngineering"></p>

                                                    <h6 style="opacity: 0.8;">PRODUCT DESIGN</h6>
                                                    <p id="displayProductDesign"></p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="bg-dark" />

                    <h3 class="mt-3 text-center"><b style="color: #5e72e4;">Schedule</b></h3>
                    <div class="container">
                        <div class="px-3 pt-2 pb-3">
                            <table id="activitiesTable" class="table table-bordered mt-3 table-responsive" style="vertical-align: middle;">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="pl-2 rubik-font" style="color: #5e72e4;">Meeting Date</th>
                                        <th class="pl-2 rubik-font" style="color: #5e72e4;">Start Date</th>
                                        <th class="pl-2 rubik-font" style="color: #5e72e4;">Finish Date CMT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-dark activity-row">
                                        <td class="rubik-font">
                                            <p id="displayMeetingDate"></p>
                                        </td>
                                        <td class="rubik-font">
                                            <p id="displaystart_date"></p>
                                        </td>
                                        <td class="rubik-font">
                                            <p id="displayfinish_cmtCMT"></p>
                                        </td>
                                    <tr>
                                    </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h3><b style="color: #5e72e4;">Remarks</b></h3>
                    <div class="card-body p-3 rubik-font toy-note remarks-container">
                        <p class="rubik-font mt-2" style="white-space: pre-line;" id="displayRemarks"></p>
                    </div>


                    <div style="text-align: right;" class="mt-4">
                        <input type="button" id="prevButton" class="previous btn btn-secondary rubik-font" value="Previous" />
                        <input type="button" id="saveDraftButton" class="draft btn btn-secondary rubik-font" value="Draft" />
                        <input type="submit" name="submit" id="submitNewProjectButton" class="btn btn-primary rubik-font" value="Submit" />
                    </div>

                </div>
            </div>
    </fieldset>

    @include('layouts.footer')
</div>
{{-- Nambahin footer dari layout || footer di akhir --}}


{{-- Modal harus di luar div --}}





<script>
    $(document).ready(function() {
        // Add a click event handler to the "Add New" button
        $("#append").click(function() {
            // Clone and append the hidden content
            var newElement = $("#hidden-content").clone().removeAttr("id").show();
            $("#elements-container").append(newElement);
        });
    });

    $(document).ready(function() {
        var current_fs, next_fs, previous_fs; // fieldsets
        var opacity;

        $("#nextButton").click(function() {
            // Get the current fieldset
            var current_fs = $(this).closest("fieldset");

            // Get the next fieldset
            var next_fs = current_fs.next("fieldset");

            // Show the next fieldset
            next_fs.show();

            // Hide the current fieldset
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    var opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });


        // Function to handle the "Previous" button
        $("#prevButton").click(function() {
            current_fs = $(this).closest("fieldset");
            previous_fs = current_fs.prev("fieldset");

            // Show the previous fieldset
            previous_fs.show();

            // Hide the current fieldset
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });

        // Function to preview images when selected
        function previewImage() {
            var previewContainer = document.getElementById('imagePreviewContainer');
            var files = document.getElementById('input_image').files;

            previewContainer.innerHTML = ''; // Clear previous previews

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-image');
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }

        // Attach the previewImage function to the change event of the file input element
        document.getElementById('input_image').addEventListener('change', previewImage);


        // Function to handle the "Save as Draft" button
        $("#saveDraftButton").click(function() {
            // Add your logic to save the form as a draft
        });

        // Function to handle the "Save Changes" button
        $("#saveChangesButton").click(function() {
            // Add your logic to save the form changes
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Function to display the uploaded image
        function displayUploadedImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#uploadedImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                // If no image is selected, display the default image and log a message
                $('#uploadedImage').attr('src',
                    'https://cdn3d.iconscout.com/3d/premium/thumb/no-photo-5590994-4652997.png');
                console.log('No image selected. Displaying default image.');
            }
        }

        // Trigger the displayUploadedImage function when a file is selected
        $('#input_image').change(function() {
            displayUploadedImage(this);
        });

        // Function to display filled data
        function displayFilledData() {
            // You can include other form data processing here
            // For now, let's just display the uploaded image
            displayUploadedImage($('#input_image')[0]);
        }

        // Attach the displayFilledData function to the click event of the "Next Step" button
        $('#nextButton').click(function() {
            displayFilledData();
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        // Function to calculate the finish date based on the start date
        function calculatefinish_cmt(start_date) {
            // Create a Date object from the start date
            var start_dateObj = new Date(start_date);

            // Calculate finish date (17 days later)
            var finish_cmt = new Date(start_dateObj);
            finish_cmt.setDate(start_dateObj.getDate() + 17);

            // Format the finish date as YYYY-MM-DD
            var finish_cmtString = finish_cmt.toISOString().slice(0, 10);

            // Return the finish date
            return finish_cmtString;
        }

        // Function to update the "Day" input based on the selected date
        function updateDay(dateInputId, dayInputId) {
            var selectedDate = $('#' + dateInputId).val();

            // Check if a date is selected
            if (selectedDate) {
                // Calculate the day based on the selected date
                var day = calculateDay(selectedDate);

                // Update the "Day" input field
                $('#' + dayInputId).val(day);
            } else {
                // If no date is selected, clear the "Day" input field
                $('#' + dayInputId).val('');
            }
        }

        // Function to calculate the day based on the selected date
        function calculateDay(date) {
            // Create a Date object from the selected date
            var selectedDateObj = new Date(date);

            // Get the day of the week as a number (0 for Sunday, 1 for Monday, ..., 6 for Saturday)
            var dayOfWeekNumber = selectedDateObj.getDay();

            // Check if the day is a weekend day (Saturday or Sunday)
            if (dayOfWeekNumber === 0 || dayOfWeekNumber === 6) {
                return "Weekend";
            } else {
                // Get the day of the week as a string (e.g., "Monday", "Tuesday", etc.)
                var dayOfWeek = selectedDateObj.toLocaleDateString('en-US', {
                    weekday: 'long'
                });
                return dayOfWeek;
            }
        }

        // Attach the updateDay function to the change event of each "Date" input
        $('.date-input').change(function() {
            var dateInputId = $(this).attr('id');
            var dayInputId = dateInputId.replace('date', 'day');
            updateDay(dateInputId, dayInputId);
        });

        // Attach the calculatefinish_cmt function to the change event of the "Start Date" input
        $('#start_date').change(function() {
            // Get the selected start date
            var start_date = $(this).val();

            // Check if a start date is selected
            if (start_date) {
                // Calculate the finish date based on the selected start date
                var finish_cmt = calculatefinish_cmt(start_date);

                // Update the "Finish Date" input field with the calculated finish date
                $('#finish_cmt').val(finish_cmt);

                // Update the "Finish Day" input field with the day corresponding to the calculated finish date
                updateDay('finish_cmt', 'finishday');
            } else {
                // If no start date is selected, clear the "Finish Date" input field
                $('#finish_cmt').val('');

                // If no start date is selected, clear the "Finish Day" input field
                $('#finishday').val('');
            }
        });

        $('#meeting').change(function() {
            updateDay('meeting', 'koday');
        });

        $('#start_date').change(function() {
            updateDay('start_date', 'startday');
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Declare formData variable
        var formData = {};

        // Function to display filled data
        function displayFilledData() {
            // Populate formData with form values
            formData = {
                'Product ID': $('#productID').val(),
                'Project Name': $('#toyName').val(),
                'Product Engineering': $('#pe').val(),
                'Product Design': $('#designer').val(),
                'Category Material': $('#category').val(),
                'Product Description': $('#description').val(),
                'Meeting Date': $('#meeting').val(),
                'Start Date': $('#start_date').val(),
                'Finish Date (CMT)': $('#finish_cmt').val(),
                'Remarks': $('#remarks').val()
            };

            // Display the filled data
            console.log(formData);
            // You can also display the data in a modal, alert, or any other way you prefer
        }

        // Function to display form data
        function displayFormData() {
            // Function to format date as MM-DD-YYYY
            function formatDate(inputDate) {
                var dateObj = new Date(inputDate);
                var month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
                var day = dateObj.getDate().toString().padStart(2, '0');
                var year = dateObj.getFullYear();
                return month + '-' + day + '-' + year;
            }

            // Check if remarks is empty and display accordingly
            var remarks = formData['Remarks'] || '<i>No remarks...</i>';
            $('#displayRemarks').html(remarks);


            // Display form data in respective placeholders
            $('#displayProductID').text(formData['Product ID'] || '--');
            $('#displayProjectName').text(formData['Project Name'] || '--');
            $('#displayProductEngineering').text(formData['Product Engineering'] || '--');
            $('#displayProductDesign').text(formData['Product Design'] || '--');
            $('#displayCategoryMaterial').text(formData['Category Material'] || '--');
            $('#displayProductDescription').text(formData['Product Description'] || '--');
            $('#displayMeetingDate').text(formatDate(formData['Meeting Date']) || '--');
            $('#displaystart_date').text(formatDate(formData['Start Date']) || '--');
            $('#displayfinish_cmtCMT').text(formatDate(formData['Finish Date (CMT)']) || '--');
        }

        // Attach the displayFilledData and displayFormData functions to the click event of the "Next Step" button
        $('#nextButton').click(function() {
            displayFilledData(); // Display the filled data
            displayFormData(); // Display the form data
        });

        // Call displayFormData initially to populate the form data
        displayFormData();
    });
</script>





<script>
$(document).ready(function() {
    $("#submitNewProjectButton").click(function(e) {
        e.preventDefault(); 

        $.ajax({
    url: "{{ route('storeNewProject') }}",
    type: "POST",
    data: $("form").serialize(),
    success: function(response) {
        console.log(response);
        // Redirect to project list page
        window.location.href = "{{ route('projectlist') }}";
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
    }
});

    });
});
</script>

@endsection