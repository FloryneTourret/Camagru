document.getElementById('pictures').style.display = "block";
document.getElementById('display_pictures').classList.add("is-active");
document.getElementById('likes').style.display = "none";
document.getElementById('display_likes').classList.remove("is-active");

function display_pictures(){
    document.getElementById('pictures').style.display = "block";
    document.getElementById('display_pictures').classList.add("is-active");
    document.getElementById('likes').style.display = "none";
    document.getElementById('display_likes').classList.remove("is-active"); 
    
}

function display_likes(){
    document.getElementById('pictures').style.display = "none";
    document.getElementById('display_pictures').classList.remove("is-active");
    document.getElementById('likes').style.display = "block";
    document.getElementById('display_likes').classList.add("is-active");
    
}

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

function load(url, element) {
    req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
			element.innerHTML = req.responseText;
			
			var now = new Date(Date.now()).getTime();
			var offset = new Date(Date.now()).getTimezoneOffset();

			var timestamp = element.getElementsByClassName("timestamp");
			for (var i = 0; i < timestamp.length; i++) {
				var date = timestamp[i].innerHTML;

				var t = date.split(/[- :]/);
				var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
				d = d.getTime();

				timestamp[i].innerHTML = timeDifference(now, d, offset);
			}
        }
    };
    req.open("GET", url, true);
    req.send(null); 
}

function close_modal(){
    modal = document.getElementById("modal").classList.remove("is-active");
    document.body.classList.remove("is-clipped");
}

function open_modal(id){
    load("/index.php/Profile/picture/" + id, document.getElementById("picture_modal"));

    document.getElementById("modal").classList.add("is-active");
    document.body.classList.add("is-clipped");
}

function like(likes, id){
	req = new XMLHttpRequest();
	req.open("GET", '/index.php/Profile/picture/' + id + '?like=true', true);
    req.send(null); 
	document.getElementById('likes').innerHTML = '<span class="has-text-danger is-size-5 like" id="unlike" onclick="unlike('+ (likes + 1) +', '+ id +')"><i class="fas fa-heart"></i>'+ (likes + 1) +'</span>';
}

function unlike(likes, id){
	req = new XMLHttpRequest();
	req.open("GET", '/index.php/Profile/picture/' + id + '?unlike=true', true);
    req.send(null); 
	document.getElementById('likes').innerHTML = '<span class="has-text-danger is-size-5 like" id="like" onclick="like('+ (likes - 1) +', '+ id +')"><i class="far fa-heart"></i>'+ (likes - 1) +'</span>';
}

function delete_picture(id){
	if ( confirm( "Êtes vous sur de vouloir supprimer cette image ? Cette action est irreversible." ) ) {
		req = new XMLHttpRequest();
		req.open("GET", '/index.php/Profile/picture/' + id + '?delete=true', true);
		req.send(null);
		document.location.reload();
	}
}

function comment(id)
{
	var comment = encodeURIComponent(document.getElementById('comment_content').value.trim());
	if(comment!= '')
	{
		req = new XMLHttpRequest();
		req.open("GET", '/index.php/Profile/picture/' + id + '?comment=' + comment, true);
		req.send(null);
		load("/index.php/Profile/picture/" + id, document.getElementById("picture_modal"));
	}
	
}