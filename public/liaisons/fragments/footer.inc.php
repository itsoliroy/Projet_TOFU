        </div>
        <footer id="pied-de-page">
            <p class="text-center">Proto par Olivier Lemay & Olivier Roy | &copy; Tous droits réservés</p>
        </footer>

        <script
                src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
                crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="node_modules/jquery/dist/jquery.js">\x3C/script>')</script>
        <script src="liaisons/js/optionEcheance.js"></script>

        <script src="liaisons/js/menuMobile.js"></script>
        <script src="liaisons/js/barreOnglets.js"></script>
        <script>
            $(document).ready(function(){
                $('body').addClass('js');
                menuMobile.initialiser();
                barreOnglets.initialiser();
            });
        </script>
        </body>


</html>


