$(document).ready(function() {
     "use strict";
            $("#add_manufacturer").submit(function(event)
            {
                event.preventDefault();
                var formdata = new FormData($(this)[0]);

                $.ajax({
                    url:  $(this).attr("action"),
                    type: $(this).attr("method"),
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (data, status)
                    {
                        if (data == true) {
                            $('#message').css('display','block');
                            $('#message').html('manufacturer added successfully');
                            setTimeout(function(){
                                window.location.href = window.location.href;
                            }, 2000);
                        }else{
                            $('#error_message').css('display','block');
                            $('#error_message').html('manufacturer already exist !');
                        }
                    },
                    error: function (xhr, desc, err)
                    {


                    }
                });
            });

            $("#add_category").submit(function(event)
            {
                event.preventDefault();
                var formdata = new FormData($(this)[0]);

                $.ajax({
                    url:  $(this).attr("action"),
                    type: $(this).attr("method"),
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (data, status)
                    {
                        if (data == true) {
                            $('#message1').css('display','block');
                            $('#message1').html('Category Added successfully');
                            setTimeout(function(){
                                window.location.href = window.location.href;
                            }, 1000);
                        }else{
                            $('#error_message1').css('display','block');
                            $('#error_message1').html('already exist');
                        }
                    },
                    error: function (xhr, desc, err)
                    {


                    }
                });
            });

                });
     