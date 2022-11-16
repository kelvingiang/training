<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link type="text/css" href="webassist/datepicker/untitled1_datepicker_1/jquery-ui.css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#datepicker_1').datepicker({
		dateFormat: 'mm/dd/yy',
		showAnim: 'show',
		onSelect: function(dateText){
        var seldate = $(this).datepicker('getDate');
        seldate = seldate.toDateString();
        seldate = seldate.split(' ');
        var weekday=new Array();
            weekday['Mon']="Monday";
            weekday['Tue']="Tuesday";
            weekday['Wed']="Wednesday";
            weekday['Thu']="Thursday";
            weekday['Fri']="Friday";
            weekday['Sat']="Saturday";
            weekday['Sun']="Sunday";
        var dayOfWeek = weekday[seldate[0]];
        $('#dayOfWeekSpan').html("You selcted "+dayOfWeek+"");
		},
		onClose: closeDatePicker_datepicker_1
	});
});
function closeDatePicker_datepicker_1() {
	var tElm = $('#datepicker_1');
	if (typeof datepicker_1_Spry != null && typeof datepicker_1_Spry != "undefined" && test_Spry.validate) {
		datepicker_1_Spry.validate();
	}
	tElm.blur();
}


</script>
</head>

<body>
<input id="datepicker_1" name="test" type="text" />

<span id="dayOfWeekSpan"></span>
</body>
</html>
