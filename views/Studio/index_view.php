<!-- Div video capture -->
<div id="snapping-div"> 
    <div class="columns snap-container" id="snapping">
        <div class="column is-8 is-offset-2">
            <video autoplay="true" id="videoElement"></video>
            <button onclick="snapshot();">Take Snapshot</button>
            <button class="button" onclick="showupload();">Upload une photo</button>
        </div>
    </div>

    <canvas id="myCanvas" width="619.5" height="464.53"></canvas>

    <div id="img-from-snap" class="has-text-centered">
        <img id="snap-output" src="">
    </div>
    <!-- Filter list -->
    <div class="columns">
        <div class="column is-6 is-offset-3" id="div-filter-snap">
            <label class="label">Filtre<i class="fas fa-info-circle" id="info"></i></label>
            <div id="list-filters">
            </div>
        </div>
    </div>

    <div class="columns">

        <!-- Snap form -->
        <div class="column is-half is-offset-one-quarter" id="snapform">
            <form action="/index.php/Studio" method="post" id="snap-form">
                <input type="hidden" id="snap-img" name="snap-img">

                <div class="field">
                    <label class="label">Description<i class="fas fa-info-circle" id="info"></i></label>
                    <input class="input" type="text" name="desc-img" placeholder="Decrivez votre photo" required>
                </div>

                <div class="field">
                    <input type="hidden" name="filter-snap" id="filter-snap">
                    <button class="button is-small is-fullwidth is-primary" type="submit">Envoyer la photo</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Uploading div -->
<div id="uploading-div">
    <div class="columns">
        <div class="column is-6 is-offset-3">
            <img id="output">
        </div>
    </div>
    <!-- Upload form -->
    <div class="columns">
        <div class="column is-half is-offset-one-quarter" id="uploadform">
            <form action="/index.php/Studio" method="post" enctype="multipart/form-data" class="form_upload">

                <!-- filter container -->
                <div id="container-filters">
                </div>

                <div class="field">
                    <label class="label">Description<i class="fas fa-info-circle" id="info"></i></label>
                    <input class="input" type="text" name="desc-img-up" placeholder="Decrivez votre photo" required>
                </div>

                <div class="file has-name">
                    <label class="file-label">
                    <input class="file-input" id="file_upload" onchange="name_input();loadFile(event);" type="file" name="newimg" id="newimg" accept="image/*">
                        <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Séléctionner un fichier
                        </span>
                        </span>
                        <span class="file-name" id="file_output">
                            Aucun fichier sélectionné
                        </span>
                    </label>
                </div>
                <div class="field">
                    <input type="hidden" name="filter" id="filter_path_up">
                    <button class="button is-small is-fullwidth is-primary" type="submit">Charger la photo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

canvas = document.getElementById("myCanvas");
ctx = canvas.getContext('2d');
check = 0;
checkupload = 0;

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

var video = document.querySelector("#videoElement");
if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
    video.srcObject = stream;
    })
    .catch(function (err0r) {
    });
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

function updatefilter()
{
    if(check == 0)
    {
        container = document.getElementById('list-filters');
        check = 1;
        var filters = <?php echo json_encode($filters); ?>;
        filters.forEach(function(element) {
            var img = document.createElement('img');
            img.src = '/'+element['filter_path'];
            img.setAttribute('onclick', "fillinput('"+element['filter_path']+"')");
            container.appendChild(img);
        });
        var img = document.createElement('img');
        img.src = '/assets/img/none.png';
        img.setAttribute('onclick', "fillinput('none')");
        container.appendChild(img);
    }
}

function uploadfilter()
{
    var output = document.getElementById('output').src;
    if (checkupload == 0 && output != '')
    {
        console.log('cocueiowyior3b');
        container = document.getElementById('container-filters');
        checkupload = 1;
        var filters = <?php echo json_encode($filters); ?>;
        filters.forEach(function(element) {
            var img = document.createElement('img');
            img.src = '/'+element['filter_path'];
            img.setAttribute('onclick', "fillinputupload('"+element['filter_path']+"')");
            container.appendChild(img);
        });
        var img = document.createElement('img');
        img.src = '/assets/img/none.png';
        img.setAttribute('onclick', "fillinputupload('none')");
        container.appendChild(img);
    }
}

function fillinputupload(path)
{
    var el = document.getElementById('filter_path_up');
    if (path != 'none')
        el.value = '/'+path;
    else
        el.value = "none";
}

function fillinput(path)
{
    var el = document.getElementById('filter-snap');
    if (path != 'none')
        el.value = '/'+path;
    else
        el.value = "none";
}

function showupload()
{
    cameradiv = document.getElementById('snapping-div');
    cameradiv.style.display = "none";
    uploaddiv = document.getElementById('uploading-div');
    uploaddiv.style.display = "block";
}

setInterval(updatefilter, 1000);
setInterval(uploadfilter, 1000);

</script>