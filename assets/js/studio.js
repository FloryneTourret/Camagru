canvas = document.getElementById("myCanvas");
ctx = canvas.getContext('2d');
check = 0;
check2 = 0;

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
    var cc = document.getElementById('snapform');
    cc.style.display = "block";
    var kk = document.getElementById('uploadform');
    var bb = document.getElementById('preview-upload');
    bb.style.display = "none";
    kk.style.display = "none";
    var check = document.getElementById('snap-img');
    if (check.value == '')
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
            });
        }
    }
}

function fillinput(path)
{
    var el = document.getElementById('filter_path_up');
    if (path != 'none')
        el.value = '/'+path;
    else
        el.value = "none";
}

function fillinput2(path)
{
    var el = document.getElementById('filter-snap');
    if (path != 'none')
        el.value = '/'+path;
    else
        el.value = "none";
}

function showupload()
{
    var cc = document.getElementById('snapform');
    cc.style.display = "none";
    document.getElementById('preview-upload').style.display = "block";
    var video = document.getElementById('snapping');
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