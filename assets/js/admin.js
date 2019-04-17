document.getElementById('filters').style.display = "none";
document.getElementById('display_filters').classList.remove("is-active");
document.getElementById('users').style.display = "block";
document.getElementById('display_users').classList.add("is-active");

function display_filters(){
    document.getElementById('filters').style.display = "block";
    document.getElementById('display_filters').classList.add("is-active");
    document.getElementById('users').style.display = "none";
    document.getElementById('display_users').classList.remove("is-active"); 
    
}

function display_users(){
    document.getElementById('filters').style.display = "none";
    document.getElementById('display_filters').classList.remove("is-active");
    document.getElementById('users').style.display = "block";
    document.getElementById('display_users').classList.add("is-active"); 
    
}

function ban(id, enabled, admin){
    const req = new XMLHttpRequest();
    req.open('GET', '/index.php/Admin?ban=' + id, true); 
    req.send(null);

    if ( confirm( "Bannir l'utilisateur ?" ) ) {
        document.getElementById('name_'+id).classList.remove("has-text-primary");
        document.getElementById('name_'+id).classList.remove("has-text-danger");
        document.getElementById('name_'+id).classList.remove("has-text-warning");
        document.getElementById('name_'+id).classList.remove("has-text-grey-dark");
        
        document.getElementById('name_'+id).classList.add("has-text-danger");
        document.getElementById('button_'+id).innerHTML = '<button class="button is-small is-warning" onclick="unban(\''+ id +'\' , \''+ enabled +'\' , \''+ admin +'\')">Autoriser l\'utilisateur</button>';
    }
}

function unban(id, enabled, admin){
    const req = new XMLHttpRequest();
    req.open('GET', '/index.php/Admin?unban=' + id, true); 
    req.send(null);
    if ( confirm( "Autoriser l'utilisateur ?" ) ) {
        document.getElementById('name_'+id).classList.remove("has-text-danger");
        if(admin == 1)
            document.getElementById('name_'+id).classList.add("has-text-primary");
        else if (enabled == -1)
            document.getElementById('name_'+id).classList.add("has-text-grey-dark");
        else if (enabled == 0)
            document.getElementById('name_'+id).classList.add("has-text-warning");
        else if (enabled == 1)
            document.getElementById('name_'+id).classList.add("has-text-grey-dark");
            document.getElementById('button_'+id).innerHTML = '<button class="button is-small is-danger" onclick="ban(\''+ id +'\' , \''+ enabled +'\' , \''+ admin +'\')">Bannir l\'utilisateur</button>';
    }
}