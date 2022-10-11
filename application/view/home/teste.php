<div class="content-wrapper">
<?php 
    echo '<pre>', var_dump($teste); echo '</pre>';
    ?>

    <section class="content container-fluid">
    <div class="box-body">
            <table class="table table-bordered table-striped smarttable">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($teste as $teste) : ?>
                        <tr>
                            <td><?php echo $teste->strTesteNome; ?></a></td>
                            <td><?php echo $teste->strTesteStatus; ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</p>
</div>

