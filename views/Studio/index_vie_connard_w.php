<div class="columns snap-container" id="snapping">
    <div class="column is-6 is-offset-3">
        <video autoplay="true" id="videoElement"></video>
        <button onclick="snapshot();">Take Snapshot</button>
        <button class="button" onclick="showupload();">Upload une photo</button>
    </div>
</div>

<!-- Preview upload -->
<div class="columns" id="preview-upload">
    <div id="img-output" class="column is-4 is-offset-4">
        <img id="output">
    </div>
</div>

<!-- Objet canvas -->
<canvas id="myCanvas" width="619.5" height="464.53"></canvas>

<div id="img-from-snap" class="has-text-centered">
    <img id="snap-output" src="">
    <input type="hidden" id="snap-img" name="snap-img">
</div>

<!-- Filter list from snap -->
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

<div class="columns">
<!-- Upload form -->
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

<script src="/assets/js/studio.js"></script>
<script>

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

function updatefilter()
{
    $prev = document.getElementById('output').src;
    if($prev != '' && check == 0)
    {
        container = document.getElementById('container-filters');
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

function updatefilter2()
{
    if(check2 == 0)
    {
        container = document.getElementById('list-filters');
        check2 = 1;
        var filters = <?php echo json_encode($filters); ?>;
        filters.forEach(function(element) {
            var img = document.createElement('img');
            img.src = '/'+element['filter_path'];
            img.setAttribute('onclick', "fillinput2('"+element['filter_path']+"')");
            container.appendChild(img);
        });
        var img = document.createElement('img');
        img.src = '/assets/img/none.png';
        img.setAttribute('onclick', "fillinput2('none')");
        container.appendChild(img);
    }
}

setInterval(updatefilter, 1000);
setInterval(updatefilter2, 1000);

</script>