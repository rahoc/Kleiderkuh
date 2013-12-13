// JavaScript Document

function setWatermark(lang) {
	
	var watermark = 'Suche (z.B. Armani)...';
	if (lang==="en") {
		watermark = 'Search (i.e. Armani)...';
	}
	
	//init, set watermark text and class
	$('#brandSearch').val(watermark).addClass('watermark');
 
	//if blur and no value inside, set watermark text and class again.
	$('#brandSearch').blur(function(){
		if ($(this).val().length == 0){
			$(this).val(watermark).addClass('watermark');
		}
	});
 
	//if focus and text is watermrk, set it to empty and remove the watermark class
	$('#brandSearch').focus(function(){
		if ($(this).val() == watermark){
			$(this).val('').removeClass('watermark');
		}
	});
	
}