<?php $this->layout("master") ?>

<div class="container mt-5">
    <!-- Título do Perfil -->
    <div class="row">
        <div class="col-12 text-center">
            <h2>Perfil de <?= htmlspecialchars($user->name) ?></h2>
        </div>
    </div>

    <!-- Cartão com as informações do perfil -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">
                    <h5>Detalhes do Usuário</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Foto do Usuário (Se tiver) -->
                        <div class="col-md-4 text-center">
                            <img src="<?= $user->profile_picture ?? 'default-avatar.png' ?>" alt="Foto de Perfil" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        </div>
                        <!-- Informações do Usuário -->
                        <div class="col-md-8">
                            <p><strong>Nome:</strong> <?= htmlspecialchars($user->name) ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($user->email) ?></p>
                            <p><strong>Data de Criação:</strong> <?= date('d/m/Y H:i', strtotime(htmlspecialchars($user->created_at))) ?></p>
                            <p><strong>Última atualização:</strong> <?= date('d/m/Y H:i', strtotime(htmlspecialchars($user->updated_at))) ?></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="/editprofile" class="btn btn-warning">Editar Perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
