<?php $this->layout("master") ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h1 class="card-title text-center"><?= htmlspecialchars($post->title) ?></h1>
                    <p class="text-muted text-center">Por <strong><?= htmlspecialchars($post->autor) ?></strong> em <?= date('d/m/Y H:i', strtotime($post->created_at)) ?></p>
                    <hr>
                    <div class="card-text">
                        <p><?= nl2br(htmlspecialchars($post->content)) ?></p>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="/" class="btn btn-secondary">← Voltar ao Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
