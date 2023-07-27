
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
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/jquery.magnific-popup.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
        <script src="./assets/js/jquery-ui.min.js"></script>
        <script src="./assets/js/jquery.slicknav.js"></script>
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/main.js"></script>
        <script type="text/javascript">
            $('#register_date_de_naissance').datepicker({
                dateFormat: 'dd/mm/yy',
                onSelect: function () {
                    $(this).focus();
                }
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