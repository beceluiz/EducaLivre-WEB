<header>
  <nav class="nav-bar">
    <div class="logo">
      <a href="index.php">
        <img src="imgs/educa-livre-logo.png" alt="logo">
      </a>
    </div>
    <ul class="nav-list">
      <li class="nav-item">
        <a href="index.php" class="nav-link">Início</a>
      </li>
      <li class="nav-item">
        <a href="materias.php" class="nav-link">Matérias</a>
      </li>
      <li class="nav-item">
        <a href="simulados.php" class="nav-link">Simulados</a>
      </li>
      <li class="nav-item">
        <a href="dicas.php" class="nav-link">Dicas</a>
      </li>
      <li class="nav-item">
        <a href="feedbacks.php" class="nav-link">Feedbacks</a>
      </li>
    </ul>

    <?php if (isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario'])): ?>
      <div class="login-button">
        <?php
        echo '<span class="usuario-logado"> Bem Vindo, ' . $_SESSION['nome'] .'!</span>'
        ?>
        <a href="processa_logout.php"><button style="background-color: red;">Sair</button></a>
      </div>
    <?php else: ?>
      <div class="login-button">
      <a href="login.php"> <button>Entrar</button></a> 
      </div>
    <?php endif; ?>
    <div class="mobile-menu-icon">
      <button onclick="menuShow()">
        <img class="icon" src="imgs/menu_white_36dp.svg" />
      </button>
    </div>
  </nav>
  <div class="mobile-menu">
    <ul>
      <li class="nav-item">
        <a href="index.php" class="nav-link">Início</a>
      </li>
      <li class="nav-item">
        <a href="materias.php" class="nav-link">Matérias</a>
      </li>
      <li class="nav-item">
        <a href="simulados.php" class="nav-link">Simulados</a>
      </li>
      <li class="nav-item">
        <a href="dicas.php" class="nav-link">Dicas</a>
      </li>
      <li class="nav-item">
        <a href="feedbacks.php" class="nav-link">Feedbacks</a>
      </li>
    </ul>
    <div class="login-button">
      <button><a href="login.php">Entrar</a></button>
    </div>
  </div>
</header>