
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
            // Fonction pour changer l'état d'un utilisateur
            function changeUserStatus(id) {
                var element = document.getElementById(id);
                var currentHost = 'http://localhost:82/oasis';
                var url = currentHost + '/operations/editer.php';
                var datas = {'objet' : 'etat_utilisateur', 'id_utilisateur' : parseInt(id.split('-')[1]), 'id_etat' : (element.getAttribute('aria-status') === 'Activé' ? 3 : 1)};

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: datas,
                    success: function () {
                        window.location.reload();
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
                var currentHost = 'http://localhost:82/oasis';
                var url = currentHost + '/operations/editer.php';
                var datas = {'objet' : 'etat_evenement', 'id_evenement' : parseInt(id.split('-')[1]), 'id_etat' : (element.getAttribute('aria-status') === 'Activé' ? 2 : 1)};

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: datas,
                    success: function () {
                        window.location.reload();
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
                var currentHost = 'http://localhost:82/oasis';
                var url = currentHost + '/operations/editer.php';
                var datas = {'objet' : 'etat_reservation', 'id_reservation' : parseInt(id.split('-')[1]), 'id_etat' : (element.getAttribute('aria-status') === 'Servie' ? 6 : 5)};

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: datas,
                    success: function () {
                        window.location.reload();
                    },
                    error: function (xhr, error, status_description) {
                        console.log(xhr.responseJSON);
                        console.log(xhr.status);
                        console.log(error);
                        console.log(status_description);
                    }
                });
            }

            $(function () {
                // jQuery DataTable
                $('#dataList').DataTable({
                    paging: 'matchMedia' in window ? (window.matchMedia('(min-width: 500px)').matches ? true : false) : false,
                    ordering: false,
                    info: 'matchMedia' in window ? (window.matchMedia('(min-width: 500px)').matches ? true : false) : false,
                });

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