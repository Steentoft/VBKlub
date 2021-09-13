<!-- Include + PHP -->
<?php
include "../templates/adminheader.php";
include "staevne/editStaevneplan.php";
include "../BL/dbConnections/dbConnection.php";
global $conn;
?>


<div class="table-responsive-sm">
     <table class="table table-striped table-responsive-sm" id="ConventionTable">
        <thead class="thead-dark">
         <tr>
            <th scope="col">Navn</th>
            <th scope="col">Dato</th>
            <th scope="col">Start tid</th>
            <th scope="col">Stop tid</th>
            <th scope="col">Lokation</th>
            <th scope="col" class="no-sort">Rediger</th>
            <th scope="col" class="no-sort">Slet</th>
        </tr>
        </thead>
        <tbody id="Table">
        </tbody>
    </table>
</div>
<button data-keyboard="false" data-backdrop="static" data-toggle="modal" data-target="#AddConvention" id="AddConventionButton" class="btn btn-dark" >Opret Stævne</button>
<button data-keyboard="false" data-backdrop="static" data-toggle="modal" data-target="#DeleteLocations" id="DeleteLocationsButton" class="btn btn-dark" >Slet Lokationer</button>

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
<?php include "../templates/javaScriptLinks.html"?>
<script>
    $(document).ready( function () {
        $('#ConventionTable').dataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/da.json'
            },
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
                "order": []
            }]
        });
    } );
    let Id;
    let Locations = document.getElementById("LocationSelect");


    // On script load, load all locations into selects.
    LoadLocations("LocationSelect");
    LoadLocations("EditLocationSelect");
    LoadConventions();

    // On submits prevents default.
    $("#AddConventionForm").submit(function(e) {
        e.preventDefault();
        let LocationInput = document.getElementById("LocationInput").value;
        if(Locations.options[0].selected){
            if(LocationInput === "") {
                alert("Lokation kan ikke være tom");
            }else{
                $.post("staevne/editStaevneplanHandler.php",
                    {
                        action: "CreateLocation",
                        Location: LocationInput
                    },
                    function(data){
                        if(data === 0){
                            alert("Lokation eksistere allerede");
                        }else {
                            LoadLocations("LocationSelect");
                            CreateConvention(LocationInput);
                        }
                    }
                );
            }
        }
        else{
            CreateConvention();
        }
    });
    $("#EditConventionForm").submit(function(e) {
        e.preventDefault();
        CheckNewLocation("EditLocationSelect", "EditNewLocationHidden", "EditNewLocationInput", "EditLocationInput");
        UpdateConventionLocation();
    });

    // On select change if not adding location, hide add location row.
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


    // Load Conventions
    function LoadConventions(){
        <?php echo editStaevneplan::LoadConventions() ?>.forEach((Convention)=> {
            let tr = document.createElement("tr");
            tr.id = JSON.parse(Convention).id;
            td(Convention, tr, "Name");
            td(Convention, tr, "Date");
            td(Convention, tr, "Start");
            td(Convention, tr, "End");
            td(Convention, tr, "Location");
            td(Convention, tr, "Edit");
            td(Convention, tr, "Remove");
            document.getElementById("Table").appendChild(tr);
        });
    }

    // Create td
    function td(Convention, tr, text) {
        let td = tr.appendChild(document.createElement('td'));
        switch(text){
            case "Name":
                td.innerHTML = JSON.parse(Convention).name;
                break;
            case "Date":
                td.innerHTML = JSON.parse(Convention).date;
                break;
            case "Start":
                td.innerHTML = JSON.parse(Convention).start_time.slice(0, -3);
                break;
            case "End":
                td.innerHTML = JSON.parse(Convention).end_time.slice(0, -3);
                break;
            case "Location":
                td.innerHTML = JSON.parse(Convention).location;
                break;
            case "Edit":
                td.innerHTML = "<img alt='edit' class='img-row-show' onclick='EditConvention(this)' src='../billeder/edit_icon.png' data-keyboard='false' data-backdrop='static' data-toggle='modal' data-target='#EditConvention'>";
                break;
            case "Remove":
                td.innerHTML = "<img alt='delete' class='img-row-show' onclick='areYouSure(this)' src='../billeder/delete_icon.png' data-keyboard='false' data-backdrop='static' data-toggle='modal' data-target='#DeleteConvention'>";
                break;
            default:
                break;
        }
        td.id = "Convention" + text + JSON.parse(Convention).id;
    }

    // Load Locations
    function LoadLocations(id) {
        let select = document.getElementById(id);
        $(select).empty();
        if (document.querySelector('[id*="LocationSelect"]')) {
            let NewLocation = document.createElement("option");
            NewLocation.innerHTML = "Ny Lokation"
            NewLocation.id = "NewLocation";
            select.appendChild(NewLocation);
        }
        <?php echo editStaevneplan::LoadLocations() ?>.forEach((Location) => {
            let a = 0;
            let option = document.createElement("option");
            option.innerHTML = JSON.parse(Location).location;
            option.id = JSON.parse(Location).id;
            for (let i = 0; i < select.length; ++i) {
                if (select.options[i].innerHTML === option.innerHTML) {
                    a = 1;
                }
            }
            if (a === 0) {
                select.appendChild(option);
            }
        });
    }

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
    function CreateConvention(LocationInput) {
        let SelectedIndex = document.getElementById("LocationSelect").selectedIndex;
        let Location;
        if(LocationInput == null) {
            Location = document.getElementById("LocationSelect").options[SelectedIndex].id;
        }else{
            Location = LocationInput;
        }
        $.post("staevne/editStaevneplanHandler.php",
            {
                action: "CreateConvention",
                Name: document.getElementById("LocationName").value,
                Date: document.getElementById("LocationDate").value,
                Start: document.getElementById("LocationStart").value,
                End: document.getElementById("LocationEnd").value,
                Location: Location
            },
            function(){
                window.location.reload();
            }
        );
    }

    // Load locations into checkboxes
    function LoadLocationsCheckboxes(id) {
        let select =  document.getElementById(id);
        $(select).empty();
        <?php echo editStaevneplan::LoadLocations() ?>.forEach((Location) => {
            let div = document.createElement("div");
            let a = document.createElement("a");
            let checkbox = document.createElement('input');
            a.innerHTML = " " + JSON.parse(Location).location;
            checkbox.type = "checkbox";
            checkbox.id = "checkbox" + JSON.parse(Location).id;
            div.appendChild(checkbox);
            div.appendChild(a);
            select.appendChild(div);
        });
    }

    // Delete convention from database and refresh
    function deleteConvention(button){
        $.post("staevne/editStaevneplanHandler.php",
            {
                action: "DeleteConvention",
                id: button.parentElement.parentElement.id
            },
            function(){
                window.location.reload();
            }
        );
    }

    // Load conention data into editconvention modal.
    function EditConvention(button){
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
        CheckNewLocation("EditLocationSelect", "EditNewLocationHidden", "EditNewLocationInput", "EditLocationInput");
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
        $.post("staevne/editStaevneplanHandler.php",
            {
                action: "UpdateConvention",
                id: Id,
                Name: document.getElementById("EditLocationName").value,
                Date: document.getElementById("EditLocationDate").value,
                Start: document.getElementById("EditLocationStart").value,
                End: document.getElementById("EditLocationEnd").value,
                Location: Location
            },
            function(){
                window.location.reload();
            }
        );
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
                $.post("staevne/editStaevneplanHandler.php",
                    {
                        action: "CreateLocation",
                        Location: LocationInput
                    },
                    function(data){
                        if(data === 0){
                            alert("Lokation eksistere allerede");
                        }else {
                            LoadLocations("LocationSelect");
                            UpdateConvention();
                        }
                    }
                );
            }
        }else{
            UpdateConvention();
        }
    }

    // On delete convention ask for additional confirmation
    function areYouSure(button) {
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
            $.post("staevne/editStaevneplanHandler.php",
                {
                    action: "DeleteLocations",
                    Array : DeleteList
                },
                function(){
                    window.location.reload();
                }
            );
        }
    }

</script>
