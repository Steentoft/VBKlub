<?php include "../templates/header.php"; ?>
<div class="table-responsive-sm">
<table class="table table-striped table-responsive-sm">
    <thead class="thead-dark">
     <tr>
        <th scope="col">Navn</th>
        <th scope="col">Dato</th>
        <th scope="col">Start tid</th>
        <th scope="col">Stop tid</th>
        <th scope="col">Lokation</th>
        <th scope="col">Rediger</th>
        <th scope="col">Slet</th>
    </tr>
    </thead>
    <tbody id="Table">
    </tbody>
</table>
    <button data-keyboard="false" data-backdrop="static" data-toggle="modal" data-target="#AddConvention" id="AddConventionButton" class="btn btn-dark" >Nyt Stævne</button>
    <button data-keyboard="false" data-backdrop="static" data-toggle="modal" data-target="#DeleteLocations" id="DeleteLocationsButton" class="btn btn-dark" >Slet Lokationer</button>
</div>

<!-- Style -->
<style>
    .modal-dialog{
        position: relative;
        display: table; /* This is important */
        overflow-y: auto;
        overflow-x: auto;
        width: auto;
        min-width: 300px;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="AddConvention" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Stævne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="AddConventionForm">
                    <table class="table table-striped table-responsive-sm">
                        <thead class="thead-dark">
                            <tr>
                                <td>Navn</td>
                                <td><label for="LocationName"></label><input id="LocationName" maxlength="255" required/></td>
                            </tr>
                            <tr>
                                <td>Dato</td>
                                <td><label for="LocationDate"></label><input id="LocationDate" type="date" required/></td>
                            </tr>
                            <tr>
                                <td>Start tid</td>
                                <td><label for="LocationStart"></label><input id="LocationStart" type="time" required/></td>
                            </tr>
                            <tr>
                                <td>Stop tid</td>
                                <td><label for="LocationEnd"></label><input id="LocationEnd" type="time" required/></td>
                            </tr>
                            <tr>
                                <td>Lokation</td>
                                <td><label for="LocationSelect"></label><select id="LocationSelect">
                                    </select></td>
                            </tr>
                            <tr>
                                <td id="NewLocationHidden" type="hidden">Ny Lokation</td>
                                <td type="hidden" id="NewLocationInput"><label for="LocationInput"></label><input id="LocationInput" /></td>
                            </tr>
                        </thead>
                        <tbody id="Table">
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuller</button>
                <button type="submit" id="AddConventionSubmit" form="AddConventionForm" class="btn btn-primary">Gem Ændringer</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="EditConvention" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Stævne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="EditConventionForm">
                <table class="table table-striped table-responsive-sm">
                    <thead class="thead-dark">
                        <tr>
                            <td>Navn</td>
                            <td><label for="EditLocationName"></label><input id="EditLocationName" maxlength="255" required/></td>
                        </tr>
                        <tr>
                            <td>Dato</td>
                            <td><label for="EditLocationDate"></label><input id="EditLocationDate" type="date" required/></td>
                        </tr>
                        <tr>
                            <td>Start tid</td>
                            <td><label for="EditLocationStart"></label><input id="EditLocationStart" type="time" required/></td>
                        </tr>
                        <tr>
                            <td>Stop tid</td>
                            <td><label for="EditLocationEnd"></label><input id="EditLocationEnd" type="time" required/></td>
                        </tr>
                        <tr>
                            <td>Lokation</td>
                            <td><label for="EditLocationSelect"></label><select id="EditLocationSelect">
                                </select></td>
                        </tr>
                        <tr>
                            <td id="EditNewLocationHidden" type="hidden">Ny Lokation</td>
                            <td type="hidden" id="EditNewLocationInput"><label for="EditLocationInput"></label><input id="EditLocationInput" /></td>
                        </tr>
                    </thead>
                    <tbody id="Table">
                    </tbody>
                </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuller</button>
                <button type="submit" id="EditConventionSubmit" form="EditConventionForm" class="btn btn-primary">Gem Ændringer</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DeleteConvention" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Slet Stævne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Er du sikker på du ville slette dette stævne?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Nej</button>
                <button type="button" id="Yes" class="btn btn-primary">Ja</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DeleteLocations" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Slet Lokationer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Vælg lokationer.
                <div id="LocationsCheckboxes">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuller</button>
                <button type="submit" id="DeleteLocationsCheckboxes" class="btn btn-primary">Slet Lokationer</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="staevne/javascript/loadLocations.js"></script>
<script>
    function UpdatePicture(ele){
        let imgPath = ele.getAttribute('src');
        document.getElementById('modalPicture').setAttribute('src', imgPath);
    }
</script>
<script>
    let Id;
    let Locations = document.getElementById("LocationSelect");

    // Load all conventions into main table
    $.ajax({
        url: 'staevne/php/loadConventions.php',
        success:function(data){
            let Conventions = JSON.parse(data);
            Conventions.forEach((Convention)=> { // TODO: FIX dry ass havin' lips
                let tr = document.createElement("tr");
                tr.id = JSON.parse(Convention).id;
                let td1 = tr.appendChild(document.createElement('td'));
                let td2 = tr.appendChild(document.createElement('td'));
                let td3 = tr.appendChild(document.createElement('td'));
                let td4 = tr.appendChild(document.createElement('td'));
                let td5 = tr.appendChild(document.createElement('td'));
                let td6 = tr.appendChild(document.createElement('td'));
                let td7 = tr.appendChild(document.createElement('td'));

                td1.innerHTML = JSON.parse(Convention).name;
                td1.id = "ConventionName" + JSON.parse(Convention).id;
                td2.innerHTML = JSON.parse(Convention).date;
                td2.id = "ConventionDate" + JSON.parse(Convention).id;
                td3.innerHTML = JSON.parse(Convention).start_time.slice(0, -3);
                td3.id = "ConventionStart" + JSON.parse(Convention).id;
                td4.innerHTML = JSON.parse(Convention).end_time.slice(0, -3);
                td4.id = "ConventionEnd" + JSON.parse(Convention).id;
                td5.innerHTML = JSON.parse(Convention).location;
                td5.id = "ConventionLocation" + JSON.parse(Convention).id;
                td6.innerHTML = "<img alt='edit' class='img-row-show' onclick='EditConvention(this)' src='../billeder/edit_icon.png' data-keyboard='false' data-backdrop='static' data-toggle='modal' data-target='#EditConvention'>";
                td7.innerHTML = "<img alt='delete' class='img-row-show' onclick='areYouSure(this)' src='../billeder/delete_icon.png' data-keyboard='false' data-backdrop='static' data-toggle='modal' data-target='#DeleteModal'>";

                document.getElementById("Table").appendChild(tr);
            });
        }
    });

    // On submits prevents default.
    $("#AddConventionForm").submit(function(e) {
        e.preventDefault();
        let LocationInput = document.getElementById("LocationInput").value;
        if(Locations.options[0].selected){
            if(LocationInput === "") {
                alert("Lokation kan ikke være tom");
            }else{
                $.ajax({
                    url: 'staevne/php/createLocation.php',
                    type: "POST",
                    data: {
                        Location: LocationInput
                    },
                    success:function(data){
                        if(data === 0){
                            alert("Lokation eksistere allerede");
                        }else {
                            LoadLocations("LocationSelect");
                            AddConvention(LocationInput);
                        }
                    }
                });
            }
        }
        else{
            AddConvention(LocationInput);
        }
    });
    $("#EditConventionForm").submit(function(e) {
        e.preventDefault();
        CheckNewLocation("EditLocationSelect", "EditNewLocationHidden", "EditNewLocationInput", "EditLocationInput");
        UpdateConventionLocation();
    });

    // On seæect change if not adding location, hide add location row.
    $("#LocationSelect").on('change', function () {
        CheckNewLocation("LocationSelect","NewLocationHidden", "NewLocationInput", "LocationInput");
    });
    $("#EditLocationSelect").on('change', function() {
        CheckNewLocation("EditLocationSelect", "EditNewLocationHidden", "EditNewLocationInput", "EditLocationInput");
    });

    // Onlclick events
    document.getElementById('DeleteLocationsCheckboxes').onclick = function() {
        DeleteLocations();
    };
    document.getElementById('DeleteLocationsButton').onclick = function() {
        LoadLocationsCheckboxes("LocationsCheckboxes");
    };
    document.getElementById('AddConventionButton').onclick = function() {
        ClearConventionModal();
    }

    // On script load, load all locations into selects.
    LoadLocations("LocationSelect");
    LoadLocations("EditLocationSelect");

    // Check if the select is chosing to add a new location, if not remove add new location row.
    function CheckNewLocation(selectId, trId, inputId, Input) {
        let tr = document.getElementById(trId);
        let input = document.getElementById(inputId);
        let InputValue = document.getElementById(Input);
        let select = document.getElementById(selectId);
        if(select.options[0].selected){
            tr.hidden = false;
            input.hidden = false;
        }else{
            tr.hidden = true;
            input.hidden = true;
            InputValue.value = "";
        }
    }

    // Add Convention to database and refresh
    function AddConvention(LocationInput) {
        let SelectedIndex = document.getElementById("LocationSelect").selectedIndex;
        let Location;
        if(LocationInput == null) {
            Location = document.getElementById("LocationSelect").options[SelectedIndex].id;
        }else{
            Location = LocationInput;
        }
        $.ajax({
            url: 'staevne/php/createConvention.php',
            type: "POST",
            data: {
                Name: document.getElementById("LocationName").value,
                Date: document.getElementById("LocationDate").value,
                Start: document.getElementById("LocationStart").value,
                End: document.getElementById("LocationEnd").value,
                Location: Location
            },
            success:function(){
                window.location.reload();
            }
        });
    }

    // Load locations into checkboxes
    function LoadLocationsCheckboxes(id) {
        $.ajax({
            url: 'staevne/php/loadLocations.php',
            success:function(data){
                let Locations = JSON.parse(data);
                let select =  document.getElementById(id);
                $(select).empty();
                Locations.forEach((Location) => {
                    let div = document.createElement("div");
                    let a = document.createElement("a");
                    let checkbox = document.createElement('input');
                    a.innerHTML = " " + Location.location;
                    checkbox.type = "checkbox";
                    checkbox.id = "checkbox" + Location.id;
                    div.appendChild(checkbox);
                    div.appendChild(a);
                    select.appendChild(div);
                });
            }
        });
    }

    // Delete convention from database and refresh
    function deleteConvention(button){
        $.ajax({
            type: "POST",
            data: {id: button.parentElement.parentElement.id},
            url: 'staevne/php/deleteConventions.php',
            success:function() {
                location.reload();
            }
        });
    }

    // Load conention data into editconvention modal.
    function EditConvention(button){
        LoadLocations("EditLocationSelect");
        Id = button.parentElement.parentElement.id;
        document.getElementById("EditLocationName").value = document.getElementById("ConventionName" + Id).innerHTML;
        document.getElementById("EditLocationDate").value = document.getElementById("ConventionDate" + Id).innerHTML;
        document.getElementById("EditLocationStart").value = document.getElementById("ConventionStart" + Id).innerHTML;
        document.getElementById("EditLocationEnd").value = document.getElementById("ConventionEnd" + Id).innerHTML;
        let Location = document.getElementById("EditLocationSelect");
        for (let i = 0; i < Location.options.length; i++) {
            if (Location.options[i].innerHTML === document.getElementById("ConventionLocation" + Id).innerHTML) {
                Location.selectedIndex = i;
                Location.options[i].selected = true;
                break;
            }
        }
    }

    // Update convention and refresh
    function UpdateConvention() {
        let LocationInput = document.getElementById("EditLocationInput").value;
        let SelectedIndex = document.getElementById("EditLocationSelect").selectedIndex;
        let Location;
        if(LocationInput === "") {
            Location = document.getElementById("LocationSelect").options[SelectedIndex].id;
        }else{
            Location = LocationInput;
        }
        let Name = document.getElementById("EditLocationName").value;
        let Date = document.getElementById("EditLocationDate").value;
        let Start = document.getElementById("EditLocationStart").value;
        let End = document.getElementById("EditLocationEnd").value;
        $.ajax({
            type: "POST",
            data: {Id: Id, Name: Name, Date: Date, Start: Start, End: End, Location: Location},
            url: 'staevne/php/updateConvention.php',
            success:function() {
                window.location.reload();
            }
        });
    }

    // Clear convention modal
    function ClearConventionModal() {
        let Name = document.getElementById("LocationName");
        let Date = document.getElementById("LocationDate");
        let Start = document.getElementById("LocationStart");
        let End = document.getElementById("LocationEnd");
        let Location = document.getElementById("LocationSelect");
        Name.value = "";
        Date.value = "";
        Start.value = "";
        End.value = "";
        Location.options.selectedIndex = 0;
        CheckNewLocation("LocationSelect","NewLocationHidden", "NewLocationInput", "LocationInput");
    }

    // On edit update location if new location added
    function UpdateConventionLocation() {
        let Locations = document.getElementById("EditLocationSelect");
        if(Locations.options[0].selected){
            let LocationInput = document.getElementById("EditLocationInput").value;
            if(LocationInput === "") {
                alert("Lokation kan ikke være tom");
            }else{
                $.ajax({
                    url: 'staevne/php/createLocation.php',
                    type: "POST",
                    data: {
                        Location: LocationInput
                    },
                    success:function(data){
                        if(data === 0){
                            alert("Lokation eksistere allerede");
                        }else {
                            LoadLocations("EditLocationSelect");
                            UpdateConvention();
                        }
                    }
                });
            }
        }else{
            UpdateConvention();
        }
    }

    // On delete convention ask for additional confirmation
    function areYouSure(button) {
        $("#DeleteConvention").modal();
        document.getElementById('Yes').onclick = function() {
            deleteConvention(button);
        };
    }

    // Delete locations and close modal
    function DeleteLocations(){
        let DeleteList = [];
        $("#LocationsCheckboxes input[type=checkbox]").each(function() {
            let id;
            if(this.checked){
                id = this.id.slice(8);
                DeleteList.push(id);
            }
        });
        if (DeleteList !== []){
            $.ajax({
                type: "POST",
                data: {Array : DeleteList},
                url: 'staevne/php/deleteLocations.php',
                success:function(){
                    $('#DeleteLocations').modal('hide');
                }
            });
        }
    }
</script>