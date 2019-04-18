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