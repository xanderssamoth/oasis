
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
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/bootstrap4-toggle.min.js"></script>
        <script src="../assets/js/jquery.magnific-popup.min.js"></script>
        <script src="../assets/js/jquery.nice-select.min.js"></script>
        <script src="../assets/js/jquery-ui.min.js"></script>
        <script src="../assets/js/jquery.slicknav.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/cropper.min.js"></script>
        <script src="../assets/js/autosize.min.js"></script>
        <script src="../assets/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/js/sweetalert2.all.min.js"></script>
        <script src="../assets/js/main.js"></script>
        <script type="text/javascript">
            // Hôte en cours
            var currentHost = 'http://localhost:7882/oasis';
            // URL pour éditer les états dans les fonctions ci-dessous
            var url = currentHost + '/operations/editer.php';

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

            // Fonction pour changer l'état d'un utilisateur
            function changeUserStatus(id) {
                var element = document.getElementById(id);
                var datas = {'objet' : 'etat_utilisateur', 'id_utilisateur' : parseInt(id.split('-')[1]), 'id_etat' : (element.getAttribute('aria-status') === 'Activé' ? 3 : 1)};

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: datas,
                    success: function () {
                        Swal.fire({
                            title: getCookie('reussi'),
                            text: 'Cliquez sur "OK" pour recharger la page',
                            icon: 'success'
                        }).then(function(){
                            location.reload();
                        });
                    },
                    error: function (xhr, error, status_description) {
                        console.log(xhr.responseJSON);
                        console.log(xhr.status);
                        console.log(error);
                        console.log(status_description);
                    }
                });
            }

            // Fonction pour changer l'état d'un événément
            function changeEventStatus(id) {
                var element = document.getElementById(id);
                var datas = {'objet' : 'etat_evenement', 'id_evenement' : parseInt(id.split('-')[1]), 'id_etat' : (element.getAttribute('aria-status') === 'Activé' ? 2 : 1)};

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: datas,
                    success: function () {
                        Swal.fire({
                            title: getCookie('reussi'),
                            text: 'Cliquez sur "OK" pour recharger la page',
                            icon: 'success'
                        }).then(function(){
                            location.reload();
                        });
                    },
                    error: function (xhr, error, status_description) {
                        console.log(xhr.responseJSON);
                        console.log(xhr.status);
                        console.log(error);
                        console.log(status_description);
                    }
                });
            }

            // Fonction pour changer l'état d'une réservation
            function changeReservationStatus(id) {
                var element = document.getElementById(id);
                var datas = {'objet' : 'etat_reservation', 'id_reservation' : parseInt(id.split('-')[1]), 'id_etat' : (element.getAttribute('aria-status') === 'Totalité' ? 4 : 5)};

                sessionStorage.reloadAfterPageLoad = true;

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: datas,
                    success: function () {
                        Swal.fire({
                            title: getCookie('reussi'),
                            text: 'Cliquez sur "OK" pour recharger la page',
                            icon: 'success'
                        }).then(function(){
                            location.reload();
                        });
                    },
                    error: function (xhr, error, status_description) {
                        console.log(xhr.responseJSON);
                        console.log(xhr.status);
                        console.log(error);
                        console.log(status_description);
                    }
                });
            }

            // DataTable
            new DataTable('#dataList', {
                'language': {
                    "url": '../assets/js/dataTables.i18n.fr-FR.json'
                }
            });

            $(function () {
                // Auto-resize textarea
                autosize($('textarea'));
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