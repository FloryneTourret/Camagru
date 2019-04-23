canvas = document.getElementById("myCanvas");
ctx = canvas.getContext('2d');

function basename(path) {
    return path.replace(/\\/g,'/').replace( /.*\//, '' );
}

function name_input(){
    document.getElementById('file_output').innerHTML = (basename(document.getElementById('file_upload').value));
}

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
};

function showtakepicture()
{
    var uploadform = document.getElementById('uploadform');
    uploadform.style.display = "none";
    var previewup = document.getElementById('preview-upload');
    previewup.style.display = "none";
    var video = document.querySelector("#videoElement");
    var container = document.getElementById('snapping');
    container.style.display = "block";
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
        video.srcObject = stream;
        })
        .catch(function (err0r) {
        console.log("Something went wrong!");
        });
    }
}

function showupload()
{
    var video = document.getElementById('videoElement');
    video.style.display = "none";
    var uploadform = document.getElementById('uploadform');
    uploadform.style.display = "block";
}

function snapshot() {
    var video = document.getElementById('videoElement');
    ctx.drawImage(video, 0,0, canvas.width, canvas.height);
    var video = document.getElementById('videoElement');
    var image = document.createElement('img');
    image.src = canvas.toDataURL("image/png");
    var camera = document.querySelector('#videoElement');
    if (navigator.mediaDevices.getUserMedia) {
        camera.srcObject = null;
    }
    var input = document.getElementById('snap-img');
    input.setAttribute('value', image.src);
    var container = document.getElementById('snapping');
    container.style.display = "none";
    var preview = document.getElementById('snap-output');
    preview.src = image.src;
    var imgcontainer = document.getElementById('img-from-snap');
    var form = document.getElementById('snap-form');
    form.style.display = "block";
}