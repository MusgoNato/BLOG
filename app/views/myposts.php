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
                            <!-- Aqui o 'd-flex' é adicionado para alinhar todos os itens na mesma linha -->
                            <div class="d-flex">
                                <a href="/post/<?= $post['id'] ?>" class="btn btn-info btn-sm me-2">Ver mais</a>
                                
                                <form action="/myposts/editpost" method="POST" class="d-flex">
                                    <input type="hidden" name="idpost" value="<?= htmlspecialchars($post['id']) ?>">
                                    <button type="submit" name="decision" value="edit" class="btn btn-primary btn-sm me-2">Editar</button>
                                    <button type="submit" name="decision" value="delete" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </div>
                            
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
