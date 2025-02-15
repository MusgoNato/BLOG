<?php $this->layout("master") ?>

<div class="container mt-5">
    <h2 class="text-center">Meus Posts</h2>

    <div class="col-12 text-center my-3">
        <a href="/myposts/newpost" class="btn btn-primary">Criar Novo Post</a>
    </div>

    <div class="row">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>
                            <a href="/post?id=<?= $post['id'] ?>" class="btn btn-outline-primary btn-sm">Ver mais</a>
                        </div>
                        <div class="card-footer text-muted text-center">
                            Publicado em <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Você ainda não criou nenhum post.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
