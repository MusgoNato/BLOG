<?php $this->layout("master"); ?>
<div class="container mt-5">
    <!-- Título do Perfil -->
    <div class="row">
        <div class="col-12 text-center">
            <h2>Edição de Perfil</h2>
        </div>
    </div>

    <!-- Cartão com as informações do perfil -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
            <div class="card-header text-center bg-dark text-white">
                <h5>Detalhes do Usuário</h5>
            </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Informações do Usuário -->
                        <div class="col-md-8">
                            <form action="/editprofile" method="POST" enctype="multipart/form-data">
                                <!-- Foto do Usuário -->
                                <div class="text-center">
                                    <!-- Foto do Usuário -->
                                    <img id="profileImage" src="<?= !empty($user->image_path) ? $user->image_path : '/imgs/default-avatar.jpg' ?>" 
                                        class="img-fluid rounded-circle mb-3" 
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                    
                                    <br>
                                    <label for="profilePicture" class="btn btn-sm btn-outline-primary mt-2">Alterar Foto</label>
                                    <input type="file" id="profilePicture" name="image" accept="image/*" class="d-none">
                                </div>
                            
                            <div class="mb-3">
                                    <label class="form-label"><strong>Nome</strong></label>
                                    <input type="text" name="nome" value="<?= htmlspecialchars($user->name) ?>" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><strong>Email</strong></label>
                                    <input type="email" value="<?= htmlspecialchars($user->email) ?>" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><strong>Senha</strong></label>
                                    <div class="input-group">
                                        <input type="password" value="<?= htmlspecialchars($user->password) ?>" class="form-control" id="passwordInput" disabled>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            👁️
                                        </button>
                                    </div>
                                    <small class="text-muted">A senha não pode ser alterada aqui.</small>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="decision" class="btn btn-success" value="save">Salvar usuário</button>
                                    <button type="submit" name="decision" class="btn btn-danger" value="delete">Excluir usuário</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">Última atualização: <?= date('d/m/Y', strtotime($user->updated_at)) ?></small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("togglePassword").addEventListener("click", function() {
    let passwordInput = document.getElementById("passwordInput");

    passwordInput.type = passwordInput.type === "password" ? "text" : "password";
});

// Abrir seletor de arquivo ao clicar no botão "Alterar Foto"
document.getElementById("profilePicture").addEventListener("change", function(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("profileImage").src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
