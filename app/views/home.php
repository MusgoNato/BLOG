<?php $this->layout("master", ["title" => "Página Inicial"]) ?>

<?php $this->start("AllPosts") ?>
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h3 class="space-title">Explore Nossos Posts</h3>
            <input type="text" id="searchBar" class="form-control w-50 mx-auto" placeholder="Pesquise por posts..." onkeyup="filterPosts()">
        </div>
    </div>

    <div class="row" id="postsContainer">
    <?php foreach($posts as $post): ?>
        <div class="col-md-4 mb-4 post-card">
            <div class="card">
                <div class="card-body">
                <img src="<?= $post['image_path'] ?? '/imgs/default-post.jpg' ?>" alt="Imagem do Post" class="img-fluid" style="width: 100%; height: 250px; object-fit: contain; border-radius: 5px;">
                    <h5 class="card-title"><?= $post['title'] ?></h5>
                    <p class="card-text"><?= substr($post['content'], 0, 100) . '...' ?></p>
                    <p class="card-text">
                        <small class="text-muted">
                            Criado por 
                            <a href="/profile/<?= $post['user_id'] ?>">
                                <?= htmlspecialchars($post['author_name']) ?>
                            </a>
                        </small>
                    </p>
                    <!-- Linha para "Ler mais" + Likes -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/post/<?= htmlspecialchars($post['id']) ?>" class="btn btn-primary">Ler mais</a>

                        <!-- Sistema de Curtidas -->
                        <div>
                            <button class="btn btn-success" onclick="likePost(<?= $post['id'] ?>)">
                                👍 <span id="likes-<?= $post['id'] ?>"><?= $post['likes'] ?></span>
                            </button>
                            <button class="btn btn-danger" onclick="dislikePost(<?= $post['id'] ?>)">
                                👎 <span id="dislikes-<?= $post['id'] ?>"><?= $post['dislikes'] ?></span>
                            </button>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>

<script>
// Função para filtrar os posts
function filterPosts() {
    let searchInput = document.getElementById("searchBar").value.toLowerCase();
    let posts = document.querySelectorAll(".post-card");

    posts.forEach(post => {
        let title = post.querySelector(".card-title").innerText.toLowerCase();
        let content = post.querySelector(".card-text").innerText.toLowerCase();

        if (title.includes(searchInput) || content.includes(searchInput)) {
            post.style.display = "block";
        } else {
            post.style.display = "none";
        }
    });
}

// Efeito de hover no card
document.querySelectorAll(".post-card").forEach(card => {
    card.addEventListener("mouseenter", () => {
        card.querySelector(".card").classList.add("shadow-lg", "border-primary");
    });
    card.addEventListener("mouseleave", () => {
        card.querySelector(".card").classList.remove("shadow-lg", "border-primary");
    });
});

// Atualiza os números de likes e dislikes sem recarregar a página
function updateLikeDislikeUI(postId, likes, dislikes) {
    document.getElementById(`likes-${postId}`).innerText = likes;
    document.getElementById(`dislikes-${postId}`).innerText = dislikes;
}

function likePost(postId) {
    fetch('/likepost', {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ post_id: postId, type: 'like' })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateLikeDislikeUI(postId, data.likes, data.dislikes);
        } else {
            alert("Erro ao curtir o post!");
        }
    })
    .catch(error => console.error("Erro:", error));
}

function dislikePost(postId) {
    fetch('/likepost', {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ post_id: postId, type: 'dislike' })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateLikeDislikeUI(postId, data.likes, data.dislikes);
        } else {
            alert("Erro ao dar dislike no post!");
        }
    })
    .catch(error => console.error("Erro:", error));
}


</script>

<?php $this->end() ?>

<style>
/* Título com estilo futurista */
.space-title 
{
    font-family: 'Orbitron', sans-serif;
    font-size: 2rem;
}

/* Efeito hover nos cards */
.post-card .card 
{
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.post-card:hover .card 
{
    transform: translateY(-10px);
    box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
}

.card-body .btn 
{
    transition: background-color 0.3s ease;
}

/* Input de pesquisa */
#searchBar 
{
    font-size: 1rem;
}

</style>
