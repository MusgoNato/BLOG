<?php $this->layout("master") ?>

<!-- Importação dos ícones do Bootstrap (caso ainda não esteja no projeto) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<div class="container mt-5">
    <h2 class="text-center">Meus Posts</h2>

    <div class="col-12 text-center my-3">
        <a href="/myposts/newpost" class="btn btn-primary">Criar Novo Post</a>
    </div>

    <div class="row">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow position-relative">
                        <!-- Botão "Editar" no canto superior esquerdo com ícone -->
                        <form action="/myposts/editpost" method="POST" class="position-absolute top-0 start-0 m-2">
                            <input type="hidden" name="idpost" value="<?= htmlspecialchars($post['id']) ?>">
                            <button type="submit" name="decision" value="edit" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </form>

                        <!-- Botão "Excluir" no canto superior direito com ícone -->
                        <form action="/myposts/editpost" method="POST" class="position-absolute top-0 end-0 m-2">
                            <input type="hidden" name="idpost" value="<?= htmlspecialchars($post['id']) ?>">
                            <button type="submit" name="decision" value="delete" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                        <div class="card-body">
                            <!-- Imagem ajustada -->
                            <img src="<?= $post['image_path'] ?? '/imgs/default-post.jpg' ?>" <img src="<?= $post['image_path'] ?? '/imgs/default-post.jpg' ?>" alt="Imagem do Post" class="img-fluid" style="width: 100%; height: 250px; object-fit: contain; border-radius: 5px;">

                            <!-- Título e conteúdo -->
                            <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>

                            <!-- Botão "Ver mais" centralizado -->
                            <div class="text-center">
                                <a href="/post/<?= $post['id'] ?>" class="btn btn-info btn-sm">Ver mais</a>
                            </div>
                        </div>
                        
                        <!-- Rodapé do card -->
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
