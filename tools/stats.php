<p class="title">Statistiques</p>

<div class="news">
    <div class="box">
        <p class="text">Bienvenue sur les <span class="BOLD">statistiques</span> de BeyServ !</p>
        <p class="exp">Sur cette page vous pourrez rechercher vos pseudos afin de trouver toutes les statistiques de vos parties !</p>
    </div>
    <div class="bobox">
        <?php
        $r = file_get_contents('https://api.beyserv.net/counts');
        $parsed_json = json_decode($r);
        $r = $parsed_json->{'minecraft'}->{'online'};
        echo "<h1 class='nmbr_player'>" . $r . " / 300 Joueurs en ligne</h1>";
        ?>
    </div>
</div>

<div class="stat">
    <?php include('stat_script.php') ?>
</div>
