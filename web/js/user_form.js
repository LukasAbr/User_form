/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    if(typeof $('#months').val() !== 'undefined'){
        getYearOptions();
        getDayOptions();
        $('#years').change(function() {
            getDayOptions();
        });
        $('#months').change(function() {
            getDayOptions();
        });
        $('#days').change(function() {
            addValueToBirthdayInput();
        });
        addValueToBirthdayInput();
    } else {
         $(':checkbox').click(function() {
            if($(this).val() == 6 && !$(':checkbox[value=6]').checked){
                $(':checkbox').prop('checked', false);
                $(':checkbox[value=6]').prop('checked', true);
            } else  if ($(this).val() == 6){
                $(':checkbox').prop('checked', false);
            } else {
                $(':checkbox[value=6]').prop('checked', false);
            }
        });
    }
});

function getYearOptions(){
    $.ajax({
        url: '/years',
        type: 'post',
        success: function (data) {
            $('#years').empty();
            $.each(JSON.parse(data), function(key, value) {   
                $('#years')
                    .append($("<option></option>")
                    .attr("value",key)
                    .text(value)); 
                $("#years option").filter(function() {
                    return this.text == value; 
                }).attr('selected', true);
            });
           
        }
    });
}

function getDayOptions(){
    var selected_year = $( "#years option:selected" ).text();
    var selected_month = $( "#months option:selected" ).text();
    var selected_day = ($( "#days option:selected" ).text()) ? $( "#days option:selected" ).text() : "01";
    $.ajax({
        url: '/days?year='+selected_year+'&month='+selected_month ,
        type: 'post',
        success: function (data) {
            $('#days').empty();
            var i = 1;
            while (i <= data) {
                var day = (i < 10) ? "0"+i : i;
                $('#days')
                    .append($("<option></option>")
                    .attr("value", day)
                    .text(day)); 
                i++;
            }
            selected_day = (selected_day >= i) ? i-1 : selected_day;
            $("#days option").filter(function() {
                return this.text == selected_day; 
            }).attr('selected', true);
            addValueToBirthdayInput(selected_day);
        }
    });
}

function addValueToBirthdayInput(selected_day = null){
    var selected_year = ($( "#years option:selected" ).text()) ? $( "#years option:selected" ).text() : "2018";
    var selected_month = $( "#months option:selected" ).text();
    var selected_day = ($( "#days option:selected" ).text()) ? $( "#days option:selected" ).text() : selected_day;
    $('#users-birth_date').val(selected_year+"-"+selected_month+"-"+selected_day);
}

function removeCheckBoxedData(){
    $(':checkbox[value=6]')
}