
        <!-- Footer Section Begin -->
        <footer class="footer-section">
            <div class="copyright-option">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="co-text text-center">
                                <p class="mb-0">
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tous droits réservés
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Js Plugins -->
        <script src="./assets/js/jquery-3.3.1.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/jquery.magnific-popup.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
        <script src="./assets/js/jquery-ui.min.js"></script>
        <script src="./assets/js/jquery.slicknav.js"></script>
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/cropper.min.js"></script>
        <script src="./assets/js/autosize.min.js"></script>
        <script src="./assets/js/jquery.dataTables.min.js"></script>
        <script src="./assets/js/dataTables.bootstrap4.min.js"></script>
        <script src="./assets/js/sweetalert2.all.min.js"></script>
        <script src="./assets/js/main.js"></script>
        <script type="text/javascript">
            // Fonction pour créer un cookie
            function setCookie(name,value,days) {
                var expires = "";

                if (days) {
                    var date = new Date();

                    date.setTime(date.getTime() + (days*24*60*60*1000));

                    expires = "; expires=" + date.toUTCString();
                }

                document.cookie = name + "=" + (value || "")  + expires + "; path=/";
            }

            // Fonction pour récupérer un cookie par son nom
            function getCookie(name) {
                var cookies = document.cookie.split(';');

                for(var i = 0 ; i < cookies.length ; ++i) {
                    var pair = cookies[i].trim().split('=');

                    if (pair[0] == name) {
                        return pair[1];
                    }
                }

                return null;
            }

            // Fonction pour supprimer des données d'une DataTable avec SweetAlert
            function deleteData(url) {
                Swal.fire({
                    title: 'Attention suppression',
                    text: 'Voulez-vous vraiment supprimer ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'

                }).then(function (result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: { 'id' : id },
                            success: function (data) {
                                if (!getCookie('reussi')) {
                                    Swal.fire({
                                        title: 'Oups !',
                                        text: 'Erreur de suppression',
                                        icon: 'error'
                                    });

                                } else {
                                    Swal.fire({
                                        title: 'Parfait',
                                        text: getCookie('reussi'),
                                        icon: 'success'
                                    });
                                    location.reload();
                                }
                            },
                            error: function (xhr, error, status_description) {
                                console.log(xhr.responseJSON);
                                console.log(xhr.status);
                                console.log(error);
                                console.log(status_description);
                            }
                        });

                    } else {
                        Swal.fire({
                            title: 'Annulée',
                            text: 'La suppression est annulée',
                            icon: 'error'
                        });
                    }
                });
            }

            // DataTable
            new DataTable('#dataList', {
                'language': {
                    "url": '../assets/js/dataTables.i18n.fr-FR.json'
                }
            });

            // jQuery DatePicker
            $('#register_date_de_naissance').datepicker({
                dateFormat: 'dd/mm/yy',
                onSelect: function () {
                    $(this).focus();
                }
            });

            // jQuery TimePicker
            $('#register_heure_debut, #register_heure_fin').timepicker({
                timeFormat: 'HH:mm:ss',
                dynamic: true,
                dropdown: true,
                scrollbar: true
            });

            /**
             * Codes pour uploader une image recadrée
             */
            var currentHost = 'http://localhost:82/oasis';
            var retrievedAvatar = document.getElementById('retrieved_image');
            var cropper;

            $('#avatar').on('change', function (e) {
                var files = e.target.files;
                var done = function (url) {
                    retrievedAvatar.src = url;

                    $('#cropModal').modal('show');
                };

                if (files && files.length > 0) {
                    var reader = new FileReader();

                    reader.onload = function () {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

            $('#cropModal').on('shown.bs.modal', function () {
                cropper = new Cropper(retrievedAvatar, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '#cropModal1 .preview'
                });

            }).on('hidden.bs.modal', function () {
                cropper.destroy();

                cropper = null;
            });

            $('#cropModal #crop').click(function () {
                // Une animation pour faire attendre l'utilisateur pendant le chargement
                $('.user-image').attr('src', currentHost + '/assets/img/ajax-loader.gif');

                var canvas = cropper.getCroppedCanvas({
                    width: 700,
                    height: 700
                });

                canvas.toBlob(function (blob) {
                    URL.createObjectURL(blob);
                    var reader = new FileReader();

                    reader.readAsDataURL(blob);
                    reader.onloadend = function () {
                        var base64_data = reader.result;
                        var user_id = document.getElementById('user_id').value;
                        var url = currentHost + '/operations/editer.php';
                        var datas = { 'objet': 'photo', 'id_utilisateur': user_id, 'avatar': base64_data };

                        $('#cropModal').modal('hide');

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: datas,
                            success: function (res) {
                                $('.user-image').attr('src', res.avatar_url);
                                window.location.reload();
                            },
                            error: function (xhr, error, status_description) {
                                console.log(xhr.responseJSON);
                                console.log(xhr.status);
                                console.log(error);
                                console.log(status_description);
                            }
                        });
                    };
                });
            });
        </script>
    </body>
</html>
<?php
if (isset($_SESSION['reussi'])) {
    unset($_SESSION['reussi']);
}
if (isset($_SESSION['erreur'])) {
    unset($_SESSION['erreur']);
}
?>