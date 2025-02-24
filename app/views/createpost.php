<?php $this->layout("master") ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Criar Novo Post</h4>
                </div>
                <div class="card-body">
                    <form action="/myposts/newpost" method="POST" enctype="multipart/form-data">
                        
                        <!-- Imagem do Post -->
                        <div class="text-center mb-4">
                        <img id="postImage" src="<?= $post['image_path'] ?? '/imgs/default-post.jpg' ?>" 
                            alt="Imagem do Post" 
                            class="img-fluid" 
                            style="width: 100%; height: 250px; object-fit: contain; border-radius: 5px;">

                            <label for="post" class="btn btn-sm btn-outline-primary mt-2">Alterar Foto</label>
                            <input type="file" id="post" name="post_image" accept="image/*" class="d-none">
                        </div>

                        <!-- Título do Post -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label"><strong>Título</strong></label>
                            <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Digite o título do post" required>
                        </div>

                        <!-- Conteúdo do Post -->
                        <div class="mb-3">
                            <label for="conteudo" class="form-label"><strong>Conteúdo</strong></label>
                            <textarea id="conteudo" name="conteudo" class="form-control" rows="5" placeholder="Escreva seu post aqui..." required></textarea>
                        </div>

                        <!-- Botão de Envio -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Publicar Post</button>
                            <a href="/myposts" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
// Abrir seletor de arquivo ao clicar no botão "Alterar Foto"
document.getElementById("post").addEventListener("change", function(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("postImage").src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>