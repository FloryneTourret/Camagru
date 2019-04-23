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
    var container = document.getElementById('videoElement');
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
}