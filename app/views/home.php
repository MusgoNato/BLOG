<?php $this->layout("master", ["title" => "Página Inicial"]) ?>

<?php $this->start("AllPosts") ?>
<div class="container mt-4">
    <div class="row">
    <?php foreach($posts as $post): ?>
        <div class="col-md-4 mb-4">     
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $post['title'] ?></h5>
                    <p class="card-text"><?= $post['content'] ?></p>
                    <a href="/post/#" class="btn btn-primary">Ler mais</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<?php $this->end() ?>
