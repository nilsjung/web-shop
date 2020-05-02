<section>
    <h1><?=$this->title?></h1>
    <table>
        <tbody>
        <?php foreach ($this->user as $u) : ?>
        <tr><td><?=$u["first_name"]?></td><td><?=$u["last_name"]?></td></tr>
        <? endforeach; ?>
        </tbody>
    </table>
</section>