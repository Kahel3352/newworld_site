<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog cascading-modal" role="document">

    <div class="modal-content">


        <div class="modal-c-tabs">


            <ul class="nav nav-tabs tabs-2 grey lighten-4" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab">
                        <i class="fa fa-user mr-1"></i> 
                        Se connecter
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-toggle="tab" href="#panel8" role="tab">
                        <i class="fa fa-user-plus mr-1"></i> 
                        S'inscrire
                    </a>
                </li>
            </ul>

            
            <div class="tab-content">

                <div class="tab-pane fade in show active" id="panel7" role="tabpanel">


                    <div class="modal-body mb-1">

                        <!--Formulaire de connexion -->
                        <form>

                            <div class="md-form form-sm">
                                <i class="fa fa-envelope prefix" ></i>
                                <input id="LoginEmail" name="email" class="form-control" type="text">
                                <label for="Email">Email</label>
                            </div>

                            <div class="md-form form-sm">
                                <i class="fa fa-lock prefix" ></i>
                                <input id="LoginPassword" name="password" class="form-control" type="password">
                                <label for="Password">Mot de passe</label>
                            </div>


                        <div id="loginError" style="color: red; text-align: center;"></div>

                            <div class="text-center mt-2">
                                <button type="button" id="loginBtn" class="btn waves-effect waves-light green">Se connecter <i class="fa fa-sign-in ml-1"></i></button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="options text-center text-md-right mt-1">
                                <p><a href="#" class="green-text">mot de passe oublié?</a></p>
                            </div>
                            <button type="button" class="btn btn-outline-green waves-effect ml-auto">Close</button>
                        </div>

                    </div>
                </form>

                <!-- /Formulaire de connexion -->
                


                <div class="tab-pane fade" id="panel8" role="tabpanel">

                    <!--Formulaire d'inscritpion -->
                    <form>
                        <div class="modal-body">

                            <div class="md-form form-sm">
                                <input id="RegisterNom" name="nom" class="form-control" type="text">
                                <label for="RegisterNom">Nom</label>
                            </div>

                            <div class="md-form form-sm">
                                <input id="RegisterPrenom" name="email" class="form-control" type="text">
                                <label for="RegisterPrenom">Prenom</label>
                            </div>

                            <div class="md-form form-sm">
                                <i class="fa fa-envelope prefix"></i>
                                <input required id="RegisterEmail" name="email" class="form-control" type="text">
                                <label for="RegisterEmail">Email</label>
                            </div>

                            <div class="md-form form-sm">
                                <i class="fa fa-envelope prefix"></i>
                                <input required id="RegisterEmailConfirmation" name="emailVerif" class="form-control" type="text">
                                <label for="RegisterEmailConfirmation">Email</label>
                            </div>

                            <div class="md-form form-sm">
                                <i class="fa fa-lock prefix"></i>
                                <input required id="RegisterPassword" name="password" class="form-control" type="password">
                                <label for="RegisterPassword">Mot de passe</label>
                            </div>

                            <div class="md-form form-sm">
                                <i class="fa fa-lock prefix"></i>
                                <input required id="RegisterPasswordConfirmation" name="passwordConfirmation" class="form-control" type="password">
                                <label for="RegisterPasswordConfirmation">Confirmation mot de passe</label>
                            </div>

                            <div class="md-form form-sm">
                                <select required id="RegisterQuestion" class="mdb-select">
                                    <option value="" disabled selected>Question de sécurité</option>
                                    <?php
                                        foreach ($questions as $key => $question){
                                            echo '<option value='.$key.'> '.$question["phraseIntitule"].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="md-form form-sm">
                                <input required id="RegisterReponse" name="reponse" class="form-control" type="text">
                                <label for="RegisterReponse">Réponse à la question de sécurité</label>
                            </div>

                            <div class="md-form form-sm">
                                <!-- <input required type="text" name="adresse" id="RegisterAdresse" class="form-control" value="" /> -->
                                <!-- <input id="RegisterAdresse" name="Adresse" class="form-control ui-autocomplete-input" autocomplete="off" type="text"> -->
                                <input autocomplete="off" class="ui-autocomplete-input" required="" name="adresse" id="RegisterAdresse" value="" type="text">
                                <label for="RegisterAdresse">Adresse</label>
                            </div>


                            <div class="md-form form-sm">
                                <input id="RegisterRue" name="Rue" class="form-control" type="text">
                                <label for="RegisterRue">Rue</label>
                            </div>

                            <div class="md-form form-sm">
                                <input id="RegisterVille" name="Ville" class="form-control" type="text">
                                <label for="RegisterVille">Ville</label>
                            </div>

                            <div class="md-form form-sm">
                                <input id="RegisterCodePostal" name="CodePostal" class="form-control" type="text">
                                <label for="RegisterCodePostal">Code postal</label>
                            </div>
                            <input id="latitude" type="text" name="latitude" hidden>
                            <input id="latitude" type="text" name="latitude" hidden>

                            <div id="registerError" style="color: red; text-align: center;"></div>

                            <div class="text-center form-sm mt-2">
                                <button id="registerBtn" class="btn btn-info waves-effect waves-light green">S'inscrire <i class="fa fa-sign-in ml-1"></i></button>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-green waves-effect ml-auto" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </form>
                <!-- /Formulaire d'inscritpion -->
                
            </div>

        </div>
    </div>
</div>
</div>

<script type="text/javascript">

    //auto complément de l'adresse ville et code postal
    $("#RegisterAdresse").autocomplete({
        appendTo: "#loginModal",
        source: function (request, response) {
            $.ajax({
                url: "https://api-adresse.data.gouv.fr/search/?limit=5",
                data: { q: request.term },
                dataType: "json",
                success: function (data) {
                    response($.map(data.features, function (item) {
                        return { label: item.properties.label, postcode: item.properties.postcode,city: item.properties.city, value: item.properties.label, street: item.properties.street, name: item.properties.name, latitude: item.geometry.coordinates[1],longitude: item.geometry.coordinates[0]};
                    }));
                }
            });
        },
        select: function(event, ui) {
            $('#RegisterCodePostal').val(ui.item.postcode);
            $('#RegisterVille').val(ui.item.city);
            if(ui.item.street)
                $('#RegisterRue').val(ui.item.street);
            else
                $('#RegisterRue').val(ui.item.name);

            //on simule l'event de l'input pour avoir l'animation associé (label du champ qui devient vert et qui remonte)
            $("#RegisterVille").trigger("change")
            $("#RegisterCodePostal").trigger("change");
            $("#RegisterRue").trigger("change")

            //on désactive l'édition des champs
            $("#RegisterVille").prop('disabled', true);
            $("#RegisterCodePostal").prop('disabled', true);
            $("#RegisterRue").prop('disabled', true);
            //$('#CodePostal').prop("disabled");
            /*$("#Latitude").val(ui.item.latitude);
            $("#Longitude").val(ui.item.longitude);*/
        }
    });

    //si l'utilisateur rechange l'adresse on réactive les champs associés
    $("#RegisterAdresse").keyup( function(e) {
        $("#RegisterVille").prop('disabled', false);
        $("#RegisterCodePostal").prop('disabled', false);
        $("#RegisterRue").prop('disabled', false);
    });

    $("#loginBtn").click( function(e) {
        var l = $("#RegisterEmail").val();
        var p = $("#RegisterPassword").val();
        console.log("<?php base_url(); ?>"+"index.php/Users/login");
        console.log(l);
        $.ajax({
            dataType: "text",
            type: "GET",
            url: "<?php base_url(); ?>"+"index.php/Users/login",
            data: { login: l, password: p},
            error: function (xhr, ajaxOptions, thrownError) {
        //console.log(xhr.status);
        console.log(thrownError);
        },
            success: function (data) {
                if (data>0)
                    location.reload();
                else
                    $("#loginError").html("Email et/ou mot de passe incorrect(s)");
            },
            fail: function(e) {
                console.log("fail: "+JSON.stringify(e));
            },
            complete: function(e) {
                console.log(JSON.stringify(e));
            }
        });
    });

    $("#registerBtn").click(function(e){
        //pour empêcher la modal de se fermer
        e.preventDefault();
        console.log("register");
        //on récupère les données du formulaire à envoyer avec la requête
        var params = {
            mail: $("#RegisterEmail").val(),
            mailConfirmation: $("#RegisterEmailConfirmation").val(),
            password: $("#RegisterPassword").val(),
            passwordConfirmation: $("#RegisterPasswordConfirmation").val(),
            prenom: $("#RegisterPrenom").val(),
            nom: $("#RegisterNom").val(),
            question: $("#RegisterQuestion").val(),
            reponse: $("#RegisterReponse").val(),
            adresse: {rue: $("#RegisterRue").val(), ville: $("#RegisterVille").val(), cp: $("#RegisterCodePostal").val()}
        };
        console.log(params);
        $.ajax({
            dataType: "text",
            type: "POST",
            url: "<?php base_url(); ?>"+"index.php/Users/register",
            data: params,
            success: function (data) {
                $("#registerError").html(data);
                console.log("data ajax: "+data);
            },
            error: function(e) {
                $("#registerError").html(e.responseText);
                console.log(e.responseText);
            }
        });
    });


</script>