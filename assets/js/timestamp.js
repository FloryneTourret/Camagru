
function timeDifference(current, previous, offset) {
	var msPerMinute = 60 * 1000;
	var msPerHour = msPerMinute * 60;
	var msPerDay = msPerHour * 24;
	var msPerMonth = msPerDay * 30;
	var msPerYear = msPerDay * 365;
	var elapsed = current - previous;
	var timezone = new Date (elapsed);
	if (timezone < msPerMinute) {
		if(Math.round(timezone / 1000) == 1)
			return 'Il y a ' + Math.round(timezone / 1000) + ' seconde';
		else
			return 'Il y a ' + Math.round(timezone / 1000) + ' secondes';
	}
	else if (timezone < msPerHour) {
		if (Math.round(timezone / msPerMinute) == 1)
			return 'Il y a ' + Math.round(timezone / msPerMinute) + ' minute';
		else
			return 'Il y a ' + Math.round(timezone / msPerMinute) + ' minutes';
	}
	else if (timezone < msPerDay) {
		if(Math.round(timezone / msPerHour) == 1)
			return 'Il y a ' + Math.round(timezone / msPerHour) + ' heure';
		else
			return 'Il y a ' + Math.round(timezone / msPerHour) + ' heures';
	}
	else if (timezone < msPerMonth) {
		if(Math.round(timezone / msPerDay) == 1)
		return 'Il y a environ ' + Math.round(timezone / msPerDay) + ' jour';
		else
			return 'Il y a environ ' + Math.round(timezone / msPerDay) + ' jours';
	}
	else if (timezone < msPerYear) {
		return 'Il y a environ ' + Math.round(timezone / msPerMonth) + ' mois';
	}
	else {
		if (Math.round(timezone / msPerYear) == 1)
			return 'Il y a environ ' + Math.round(timezone / msPerYear) + ' an';
		else
			return 'Il y a environ ' + Math.round(timezone / msPerYear) + ' ans';
	}
}

var now = new Date(Date.now()).getTime();
var offset = new Date(Date.now()).getTimezoneOffset();

var timestamp = document.getElementsByClassName("timestamp");

for (var i = 0; i < timestamp.length; i++) {
	var date = timestamp[i].innerHTML;

	var t = date.split(/[- :]/);
	var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
	d = d.getTime();

	timestamp[i].innerHTML = timeDifference(now, d, offset);
}