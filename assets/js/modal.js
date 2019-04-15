document.getElementById('info').onclick = function(){
    document.getElementById('modal').classList.add("is-active");
    document.body.classList.add("is-clipped");
};
document.getElementById('delete').onclick = function(){
    document.getElementById('modal').classList.remove("is-active");
    document.body.classList.remove("is-clipped");
};
document.getElementById('gotit').onclick = function(){
    document.getElementById('modal').classList.remove("is-active");
    document.body.classList.remove("is-clipped");

};