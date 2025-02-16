<?php $this->layout("master"); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Editar Post</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        <input type="hidden" name="idpost" value="<?= htmlspecialchars($post->id) ?>">
                        <!-- Título do Post -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label"><strong>Título</strong></label>
                            <input type="text" id="titulo" name="titulo" class="form-control" value="<?= htmlspecialchars($post->title) ?>" required>
                        </div>

                        <!-- Conteúdo do Post -->
                        <div class="mb-3">
                            <label for="conteudo" class="form-label"><strong>Conteúdo</strong></label>
                            <textarea id="conteudo" name="conteudo" class="form-control" rows="5" required><?= htmlspecialchars($post->content) ?></textarea>
                        </div>

                        <!-- Botão de Envio -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" name="decision" value="save">Salvar</button>
                            <a href="/myposts" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
