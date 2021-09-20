<?php include "../templates/adminHeader.php"; ?>


<style>
    p.card-text {
        min-height: 6vh;
    }
</style>

<div class="btn-create">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Stævneplan</h5>
                    <p class="card-text">Tilføj, rediger eller fjern stævner.</p>
                    <a href="editStaevneplan" class="btn btn-primary">Gå</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Galleri</h5>
                    <p class="card-text">Tilføj, rediger eller fjern billeder.</p>
                    <a href="editGalleri" class="btn btn-primary">Gå</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bestyrelse</h5>
                    <p class="card-text">Tilføj, rediger eller fjern medlemmer i bestyrelsen.</p>
                    <a href="editBestyrelse" class="btn btn-primary">Gå</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Administratorer</h5>
                    <p class="card-text">Tilføj, rediger eller fjern administratorer til adminpanelet.</p>
                    <a href="editAdmins" class="btn btn-primary">Gå</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Om klubben</h5>
                    <p class="card-text">Rediger indholdet af Om klubben siden.</p>
                    <a href="editOmklubben" class="btn btn-primary">Gå</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tilmelding</h5>
                    <p class="card-text">Rediger indholdet af Tilmelding siden.</p>
                    <a href="editTilmelding" class="btn btn-primary">Gå</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Forside</h5>
                    <p class="card-text">Rediger indholdet af Forsiden.</p>
                    <a href="editFrontpage" class="btn btn-primary">Gå</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Links</h5>
                    <p class="card-text">Tilføj, rediger eller fjern links.</p>
                    <a href="editLinks.php" class="btn btn-primary">Gå</a>
                </div>
            </div>
        </div>
    </div>
</div>



</div>

<?php include "../templates/javaScriptLinks.html"?>
</body>
</html>