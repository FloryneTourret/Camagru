<button class="button" onclick="showtakepicture();">Prendre une photo</button><br>
<button class="button" onclick="showupload();">Upload une photo</button>

<div class="columns snap-container">
    <div class="column is-6 is-offset-3">
        <video autoplay="true" id="videoElement"></video>
    </div>
    <button onclick="snapshot();">Take Snapshot</button> 
</div>

<div class="columns" id="preview-upload">
    <div id="img-output" class="column is-4 is-offset-4">
        <img id="output">
    </div>
</div>

<canvas  id="myCanvas" width="400" height="350"></canvas>

<!-- <div class="columns">
    <div class="column is-half is-offset-one-quarter">
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
    </div>
</div> -->

<div class="columns">

    <div class="column is-half is-offset-one-quarter" id="uploadform">
        <form action="/index.php/Studio" method="post" enctype="multipart/form-data" class="form_upload">
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
                <button class="button is-small is-fullwidth is-primary" type="submit">Charger la photo</button>
            </div>
        </form>
    </div>

</div>

<script src="/assets/js/studio.js"></script>