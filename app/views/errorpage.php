<?php $this->layout("master"); ?>

<div class="container d-flex flex-column align-items-center justify-content-center vh-100 text-center">
    <h1 class="glitch" data-text="404">404</h1>
    <p class="lead text-light">Oops! Parece que você se perdeu no espaço...</p>
    <a href="/" class="btn btn-outline-light btn-lg mt-4"><i class="bi bi-house-door"></i> Voltar para a Home</a>
</div>

<style>
/* Fundo animado estilo "neon" */
body 
{
    background: radial-gradient(circle at center, #1a1a2e, #16213e, #0f3460);
    color: #fff;
}

/* Animação de glitch */
@keyframes glitch 
{
    0% { text-shadow: 5px 0 #ff0000, -5px 0 #00ff00; }
    25% { text-shadow: -5px 0 #ff0000, 5px 0 #00ff00; }
    50% { text-shadow: 5px 0 #ff0000, -5px 0 #00ff00; }
    75% { text-shadow: -5px 0 #ff0000, 5px 0 #00ff00; }
    100% { text-shadow: 5px 0 #ff0000, -5px 0 #00ff00; }
}

.glitch 
{
    font-size: 120px;
    font-weight: bold;
    position: relative;
    display: inline-block;
    text-transform: uppercase;
    letter-spacing: 4px;
    animation: glitch 0.8s infinite alternate-reverse;
}

/* Efeito de glitch duplicado */
.glitch::before,
.glitch::after 
{
    content: attr(data-text);
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0.8;
}

.glitch::before 
{
    color: #ff0000;
    transform: translate(-2px, -2px);
    clip-path: inset(0 0 50% 0);
}

.glitch::after 
{
    color: #00ff00;
    transform: translate(2px, 2px);
    clip-path: inset(50% 0 0 0);
}

/* Botão com efeito hover */
.btn-outline-light
{
    border-color: #fff;
    color: #fff;
    transition: 0.3s;
}

.btn-outline-light:hover 
{
    background-color: #00ff00;
    border-color: #00ff00;
    color: #000;
    box-shadow: 0px 0px 15px #00ff00;
}
</style>
