/*Side Menu
==============================*/
$(document).ready(function () {
    "use strict";
    $(".side-menu ul li a").click(function (e) {
    $(".side-menu ul li ul").slideUp("slow"),
        $(this).next().is(":visible") || $(this).next().slideDown("slow"),
    e.stopPropagation()
    })
});

/* Toggle Icon
==============================*/
$(document).ready(function () {
    "use strict";
    $(".toggle-btn").click(function (){
        $(".side-menu").toggleClass("move");
        $(".main").toggleClass("move");
    });
});

/* Lock Screen
===============================*/
function lock(){
    $(".lock").show();
    $("body").css({"overflow":"hidden"});
}
function open_lock(){
    $(".lock").hide();
    $("body").css({"overflow":"auto"});
}

/* Full screen Mode
================================*/
$(document).ready(function () {
    "use strict";
    $(".open_fullscreen").click(function (){
        var elem = document.getElementById("body");
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
        $(this).hide();
        $(".exist_fullscreen").show();
    });
    $(".exist_fullscreen").click(function (){
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
        $(this).hide();
        $(".open_fullscreen").show();
    });   
});

/* Full Screen
==============================*/
$(document).ready(function () {
    "use strict";
    function headerSize() {
        var winh = $(window).height(),
            halfH = $(window).innerHeight() / 2,
            centerh = $(".center-height"),
            divHeight = $(".center-height").outerHeight(),
            divHalfHeight = divHeight / 2,
            centerDiv = halfH - divHalfHeight;
        $(".login-wrap").height(winh);
        $(".center-height").css({top: centerDiv});
    }
    headerSize();
    $(window).resize(function () {
        headerSize();
    });
});

/* DataTable
==============================*/
$(document).ready(function () {
    "use strict";
    $('#datatable_btns').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        "language": 
        {
            "sProcessing": "جارٍ التحميل...",
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sInfoPostFix": "",
            "sSearch": "ابحث:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        }
    });
    $('#datatable').DataTable({
        "language": 
        {
            "sProcessing": "جارٍ التحميل...",
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sInfoPostFix": "",
            "sSearch": "ابحث:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        }
    });
});

/* ToolTip | Popover
==============================*/
$(document).ready(function () {
    "use strict";
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
});

/* Date Picker
=============================*/
$(document).ready(function () {
    "use strict";
    $('input[name="date_range"]').daterangepicker({
        autoApply: true,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val('From :' + picker.startDate.format('MM/DD/YYYY') + '    To : ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('input[name="date_time_picker"]').daterangepicker({
        autoApply: true,
        singleDatePicker: true ,
        minYear: 1990 ,
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('input[name="date_time_picker"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY'));
  });
    $('#timepicker1').timepicker();
});

/* Tag Select
============================*/
$(document).ready(function () {
    "use strict";
    $(".select").select2({
        placeholder:'Please Select'
    });
    $('.tags').select2({
        tags: true,
        placeholder:'Please Select' ,
        tokenSeparators: [',']
    });
});

/* Upload Button
==============================*/
$(document).ready(function () {
    "use strict";
        $('.uplaod-wrap .button').click(function () {
            $(".uplaod-wrap input[type='file']").trigger('click');
        });
        $("input[type='file']").change(function () {
            $('.path').text(this.value.replace(/C:\\fakepath\\/i, ''))
        });
});


/* System Input [ Add Row ]
==================================*/
$(document).ready(function () {
    "use strict";
    $(".system_inputs").change(function () {
        var input_name = $(".system_inputs option:selected" ).val();
        if (input_name == "option-input") {
            $(".system_inputs_wrap").show();
            $(".add-item").show();
        } else{
            $(".system_inputs_wrap").hide();
            $(".add-item").hide();
        }   
    });
    var max_fields_limit = 10;
    var x = 1;
    $('.add_system_input').click(function (e) {
        e.preventDefault();
        if (x < max_fields_limit) {
            x++;
            $('.system_inputs_wrap .row').append('<div class="col-md-6 col-sm-6 system_input_cont"><div class="form-group"><input class="form-control" type="text" placeholder="Option Name"><button class="icon-btn red-bc remove_inp" onclick="remove_input(this);"><i class="fa fa-times"></i></button></div></div>')
        }
    });
});
function remove_input(el){
    el.closest('.system_input_cont').remove();
}

/* add Comment
==========================*/
$(document).ready(function () {
    "use strict";
    $(".replay-btn").click(function () {
        $(this).parent().find(".comment-field").show();
    });
    $(".close-btn").click(function () {
        $(this).parent().parent().hide();
    });
});

/* Question Type
========================*/
$(document).ready(function () {
    "use strict";
    $('input[name ="question_type"]').change(function () {
        var input_name = $(this).val();
        $(".question_type_wrap").hide();
        $("#"+input_name).show();
    });
});

/* ADD  Individually Assign 
============================*/
$(document).ready(function () {
    "use strict";
    $("#individually_assign").click(function () {
        if ($(this).is(":checked")) {
            $(".individ-meb").show();
        } else {
            $(".individ-meb").hide();
        }
    });
});

/* Submissions
========================*/
$(document).ready(function () {
    "use strict";
    $(".submissions_opt").change(function () {
        var input_name = $(".submissions_opt option:selected" ).val();
        if (input_name == "enable_until") {
            $(".date_picker_block").show();
            $(".date_picker_block2").hide();
        } else if (input_name == "enable_form_until") {
            $(".date_picker_block").hide();
            $(".date_picker_block2").show();
        } else{
            $(".date_picker_block").hide();
            $(".date_picker_block2").hide();
        }   
    });
});

/* ADD Survey Gaol
============================*/
$(document).ready(function () {
    var max_option_limit = 10;
    var x = 1;
    $('.add_survey_goal').click(function (e) {
        console.log("dsfsdfsadfgsadr");
        e.preventDefault();
        if (x < max_option_limit) {
            x++;
            $('.goal_wrap').append('<div class="row"><div class="col-md-7 form-group"><input type="text" class="form-control"placeholder="Title"></div><div class="col-md-5 form-group"><input type="text" class="form-control"placeholder="Value"><button class="icon-btn red-bc" onclick="remove_input5(this);"><i class="fa fa-times"></i></button></div></div>')
        }
    });
});
function remove_input5(el){
    el.closest('.row').remove();
}

/* ADD Option
============================*/
$(document).ready(function () {
    var max_option_limit = 10;
    var x = 1;
    $('.add-option').click(function (e) {
        e.preventDefault();
        if (x < max_option_limit) {
            x++;
            $('.option-wrap .row').append('<div class="col-md-6 col-sm-6"><div class="form-group choose-ans"><div class="radio-wrap radio-shap"><input type="checkbox" id="choice-ans"><label for="choice-ans"></label></div><input class="form-control" type="text" placeholder="Choice"><button type="button" class="icon-btn red-bc remove_field" onclick="triggerButton2(this);"><i class="fa fa-trash"></i></button></div> </div>')
        }
    });
});
function triggerButton2(el){
    el.closest('.col-md-6 , .col-sm-12').remove();
}

/* Add Order ITem
==========================*/
$(document).ready(function () {
    var max_option_limit = 10;
    var x = 1;
    $('.add-order').click(function (e) {
        e.preventDefault();
        if (x < max_option_limit) {
            x++;
            $('.order-wrap .row').append('<div class="col-md-12 col-sm-12"><div class="form-group inline"><label>item </label><input type="text" class="form-control"><button type="button" class="icon-btn red-bc remove_field" onclick="triggerButton3(this);"><i class="fa fa-trash"></i></button></div></div>')
        }
    });
});
function triggerButton3(el){
    el.closest('.col-md-12 , .col-sm-12').remove();
}

/* Add Matching
=============================*/
$(document).ready(function () {
    var max_option_limit = 10;
    var x = 1;
    $('.add-option-matching').click(function (e) {
        e.preventDefault();
        if (x < max_option_limit) {
            x++;
            $('.matching-wrap .row .form-group').append('<div class="row"><div class="col-md-6 col-sm-12"><input type="text" class="form-control" placeholder="Question"></div><div class="col-md-6 col-sm-12"><input type="text" class="form-control" placeholder="answer"></div><button type="button" class="icon-btn red-bc remove_field" onclick="triggerButton4(this);"><i class="fa fa-trash"></i></button></div><div class="h-15"></div>')
            }
    });
});
function triggerButton4(el){
    el.closest('.row').remove();
}

/*Loading
==========================*/
$(window).on("load", function () {
    "use strict";
    $(".spinner").fadeOut(function () {
        $(this).parent().fadeOut();
        $("body").css({"overflow-y" : "visible"});
    });
});