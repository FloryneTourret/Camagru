<!-- Div video capture -->
<div id="snapping-div">
    <div class="snap-container" id="snapping">
        <div class="supperpose">
            <video autoplay="true" id="videoElement" height="100%"></video>
            <div class="coucou" id="preview-filter"></div>
        </div>
    </div>

    <canvas id="myCanvas" width="559.33" height="425.8"></canvas>

    <div id="img-from-snap">
        <div class="supperpose">
            <img id="snap-output" src="">
            <div id="calque"></div>
        </div>
    </div>

    <div class="buttons-list">
        <button class="button" onclick="snapshot();">Prendre la photo</button>
        <button class="button" onclick="showupload();">Uploader une photo</button>
    </div>

    <!-- Filter list -->
    <div class="columns">
        <div class="column is-6 is-offset-3" id="div-filter-snap">
            <label class="label">Filtres</label>
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
                    <label class="label">Description</label>
                    <input class="input" type="text" name="desc-img" placeholder="Decrivez votre photo" required>
                </div>

                <div class="field">
                    <input type="hidden" name="filter-snap" id="filter-snap">
                    <button class="button is-small is-fullwidth is-primary" type="submit" id="charger_snap" style="display: none;">Publier la photo</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Uploading div -->
<div id="uploading-div">
    <div class="columns">
        <div class="supperpose2">
            <div id="suppperpose">
                <img id="output">
                <img id="output2" style="display:none">
            </div>
        </div>
    </div>
    <!-- Upload form -->
    <div class="columns">
        <div class="column is-half is-offset-one-quarter" id="uploadform">
            <form action="/index.php/Studio" method="post" enctype="multipart/form-data" class="form_upload" id="form_upload">

                <!-- filter container -->
                <div id="container-filters">
                </div>

                <div class="field" id="desc-field">
                    <label class="label">Description</label>
                    <input class="input" type="text" name="desc-img-up" placeholder="Decrivez votre photo" required>
                </div>

                <div class="file has-name" id="file_up">
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
                    <input type="hidden" name="filter" id="filter_path_up" required>
                    <button class="button is-small is-fullwidth is-primary" id="charger_photo" style="display: none;" type="submit">Publier la photo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column is-full has-text-centered">
        <p>Mes dernières photos</p>
        <div class="level">
            <div class="level-item lastphotos" id="last1"></div>
            <div class="level-item lastphotos" id="last2"></div>
            <div class="level-item lastphotos" id="last3"></div>
            <div class="level-item lastphotos" id="last4"></div>
            <div class="level-item lastphotos" id="last5"></div>
        </div>
    </div>
</div>

<script>

canvas = document.getElementById("myCanvas");
ctx = canvas.getContext('2d');
check = 0;
checkupload = 0;

var lastpic = <?php echo json_encode($lastpictures); ?>;
i = 1;
lastpic.forEach(function(element)
{
    var imgcontainer = document.getElementById('last'+i);
    var img = document.createElement('img');
    img.src = '/'+element['picture_path'];
    console.log(img.src);
    i++;
    imgcontainer.appendChild(img);
    console.log(element['picture_path']);
});

function basename(path) {
    return path.replace(/\\/g,'/').replace( /.*\//, '' );
}

function name_input(){
    document.getElementById('file_output').innerHTML = (basename(document.getElementById('file_upload').value));
}

function loadFile(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
}

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
    var prev = document.getElementById('img-from-snap');
    prev.style.display = "block";
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
            img.setAttribute('onclick', "fillinput('"+element['filter_path']+"');selectbutton(this);");
            img.setAttribute('class', 'filter-img');
            container.appendChild(img);
        });
        var img = document.createElement('img');
        img.src = '/assets/img/none.png';
        img.setAttribute('class', 'filter-img');
        img.setAttribute('onclick', "fillinput('none');selectbutton(this)");
        container.appendChild(img);
    }
}

function selectbutton(el)
{

    var output = document.getElementById('output');
    var output_naturalWidth = output.naturalWidth;
    var output_width = output.clientWidth;
    var ratio = (output_naturalWidth / output_width);

    var check = document.getElementById('output').src;
    if (check != '')
        var calc = document.getElementById('calc-upload');
    else
        var calc = document.getElementById('calque');
    var tab = document.getElementsByClassName('filter-img');
    for(i = 0; i < tab.length; i++)
    {
        tab[i].style.border = "none";
        tab[i].classList.remove("filter-active");
    }
    el.classList.add("filter-active");
    el.style.border = "1px solid black";
    preview = document.getElementById('preview-filter');
    if (el.src.substr(-8) != "none.png")
    {
        preview.style.backgroundRepeat = "no-repeat";
        preview.style.backgroundImage = "url('"+el.src+"')";
        calc.style.backgroundImage = "url('"+el.src+"')";
        calc.style.backgroundRepeat = "no-repeat";
        var filter_size = el.naturalWidth / ratio;
        calc.style.backgroundSize = filter_size + 'px';
    }
    else
    {
        preview.style.backgroundImage = null;
        calc.style.backgroundImage = null;
    }
    if(document.getElementById('snap-form').style.display == 'block')
        document.getElementById('charger_snap').style.display = 'block';
    else if(document.getElementById('uploading-div').style.display == 'block')
        document.getElementById('charger_photo').style.display = 'block';
}

function uploadfilter()
{
    var output = document.getElementById('output').src;
    var img = document.getElementById('output');
    var desc = document.getElementById('desc-field');
    if (checkupload == 0 && output != '')
    {
        var fileup = document.getElementById('file_up');
        fileup.style.display = "none";
        var container2 = document.getElementById('suppperpose');
        var calc = document.createElement('div');
        calc.style.width = img.clientWidth + 'px';
        calc.style.height = img.clientHeight + 'px';
        calc.setAttribute('id', 'calc-upload');
        container2.appendChild(calc);
        desc.style.display = "block";
        container = document.getElementById('container-filters');
        checkupload = 1;
        var filters = <?php echo json_encode($filters); ?>;
        filters.forEach(function(element) {
            var img = document.createElement('img');
            img.src = '/'+element['filter_path'];
            img.setAttribute('class', 'filter-img');
            img.setAttribute('onclick', "fillinputupload('"+element['filter_path']+"');selectbutton(this);");
            container.appendChild(img);
        });
        var img = document.createElement('img');
        img.src = '/assets/img/none.png';
        img.setAttribute('class', 'filter-img');
        img.setAttribute('onclick', "fillinputupload('none');selectbutton(this);");
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
setInterval(uploadfilter, 100);

</script>