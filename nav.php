<nav>
        <a href="/<?= langUrl() ?>"><h1>JakobLindskog<span style="color:#ff0000;font-size:.6em">.tk</span></h1></a>
        <ul>
            <li> <a href="about<?= langUrl() ?>"><?= s("Om jakoblindskog.tk","About jakoblindskog.tk") ?></a> </li>
            <li> <a href="insider<?= langUrl() ?>"><?= s("Vad finns på den här sidan?","What's on this page?") ?></a> </li>
            <li> <a href="contact<?= langUrl() ?>"><?= s("Kontakt","Contact") ?></a></li>
            <li>
            <a class="lang" href='<?= $link ?>'><?= $linkStr ?></a>
            </li>
        </ul>
</nav>