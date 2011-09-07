FB.init({
    appId:appId,
    status:true,
    cookie:true,
    fbml:true,
    oauth:true,
});


function invite()
{
    var request_ids=FB.ui({
	method: 'apprequests',
	message: 'I play festember games.I think that you should play it too',
	filters: ['app_non_users'],
	data: 'tracking information for the user',
    });
    $.ajax({
	type: "POST",
	url: "reqconnect.php",
	data: "rid=requests_ids",
    });
}
