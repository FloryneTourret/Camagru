document.getElementById('profile').style.display = "block";
document.getElementById('display_profile').classList.add("is-active");
document.getElementById('picture').style.display = "none";
document.getElementById('display_picture').classList.remove("is-active");
document.getElementById('password').style.display = "none";
document.getElementById('display_password').classList.remove("is-active");
document.getElementById('notif').style.display = "none";
document.getElementById('display_notif').classList.remove("is-active");

function display_profile(){
    document.getElementById('profile').style.display = "block";
    document.getElementById('display_profile').classList.add("is-active");
    document.getElementById('picture').style.display = "none";
    document.getElementById('display_picture').classList.remove("is-active"); 
    document.getElementById('password').style.display = "none";
    document.getElementById('display_password').classList.remove("is-active");
    document.getElementById('notif').style.display = "none";
    document.getElementById('display_notif').classList.remove("is-active");
    
}

function display_picture(){
    document.getElementById('profile').style.display = "none";
    document.getElementById('display_profile').classList.remove("is-active");
    document.getElementById('picture').style.display = "block";
    document.getElementById('display_picture').classList.add("is-active"); 
    document.getElementById('password').style.display = "none";
    document.getElementById('display_password').classList.remove("is-active");
    document.getElementById('notif').style.display = "none";
    document.getElementById('display_notif').classList.remove("is-active");
    
}

function display_password(){
    document.getElementById('profile').style.display = "none";
    document.getElementById('display_profile').classList.remove("is-active");
    document.getElementById('picture').style.display = "none";
    document.getElementById('display_picture').classList.remove("is-active");
    document.getElementById('password').style.display = "block";
    document.getElementById('display_password').classList.add("is-active");
    document.getElementById('notif').style.display = "none";
    document.getElementById('display_notif').classList.remove("is-active");
    
}

function display_notif(){
    document.getElementById('profile').style.display = "none";
    document.getElementById('display_profile').classList.remove("is-active");
    document.getElementById('picture').style.display = "none";
    document.getElementById('display_picture').classList.remove("is-active");
    document.getElementById('password').style.display = "none";
    document.getElementById('display_password').classList.remove("is-active");
    document.getElementById('notif').style.display = "block";
    document.getElementById('display_notif').classList.add("is-active");
    
}

function basename(path) {
    return path.replace(/\\/g,'/').replace( /.*\//, '' );
}
function name_input(){
    document.getElementById('file_output').innerHTML = (basename(document.getElementById('file_upload').value));
}