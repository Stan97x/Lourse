<?php
if (isset($_SESSION['user'])) {
    // Utilisateur connecté, afficher la barre de navigation pour les utilisateurs connectés
    require_once('nav_logged.php');
} else {
    require_once('nav_not_logged.php');
}
?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var firstLinks = document.querySelectorAll(".item_menu a");
        var secondLinks = document.querySelectorAll(".second_menu a");

        // Fonction pour vérifier l'URL de la page actuelle
        function checkCurrentPage() {
            var currentPageUrl = window.location.href;
            firstLinks.forEach(function(link) {
                // Vérifier si l'URL de la page actuelle correspond à l'un des liens de navigation
                if (link.href === currentPageUrl) {
                    link.classList.add("selected");
                }
            });
            secondLinks.forEach(function(link) {
                // Vérifier si l'URL de la page actuelle correspond à l'un des liens de navigation
                if (link.href === currentPageUrl) {
                    link.classList.add("selected");

                    // Si l'élément a un sous-menu, ajouter la classe 'selected' à son parent
                    var parentItem = link.closest(".item_menu");
                    if (parentItem) {
                        parentItem.classList.add("selected");
                    }
                }
            });
        }
        // Appeler la fonction pour vérifier l'URL de la page actuelle
        checkCurrentPage();
    });
</script>