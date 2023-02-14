<div class="footer">
    <p class="text-footer">Haiven Studio - BeyServ - Tout droit réservés 2022 -<span class="BOLD"> CGU - CGV</p>
    <p class="under">Site produit et réalisé par Jules</p>
</div>

<?php
$alert = $_GET['alert'];
switch ($alert) {
    case 'succesreg':
        echo '<script>alert("Vous vous êtes inscrit")</script>';
        break;
    case 'succeslog':
        echo '<script>alert("Vous vous êtes connecter")</script>';
        break;
    case 'badchar':
        echo '<script>alert("Un des champs est incorrect")</script>';
        break;
    case 'samempwd':
        echo '<script>alert("Un compte avec ce mail éxiste déjà")</script>';
        break;
    case 'samepseudo':
        echo '<script>alert("Un compte avec ce pseudo éxiste déjà")</script>';
        break;
    case 'notmail':
        echo "<script>alert('Cette e-mail n'est pas enregistré')</script>";
        break;
    case 'pwdnotmatch':
        echo "<script>alert('Le mot de passe ne correspond pas')</script>";
        break;
    case 'notconnect':
        echo "<script>alert('Vous devez être connécter pour faire cette action')</script>";
        break;
    case 'succesbuy':
        echo "<script>alert('Bravoo vous venez d'acheter un grade !')</script>";
        break;
}
?>