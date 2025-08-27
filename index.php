<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CineTech</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1 class="titulo">🎬 CineTech</h1>

    <div class="conteudo <?php if($_SERVER['REQUEST_METHOD'] === 'POST') echo 'com-resumo'; ?>">
    
      <fieldset class="form-card">
        <legend>Comprar Ingressos</legend>
        <form action="" method="post">
          
          <div class="campo">
            <label for="nomeCliente">Nome:</label>
            <input type="text" name="nomeCliente" id="nomeCliente" required>
          </div>

          <div class="campo">
            <label for="tipoFilme">Filmes em Cartaz:</label>
            <select name="tipoFilme" id="tipoFilme" required>
              <option value="">Escolha um filme</option>
              <option value="Os caras malvados 2 - R$ 30,00">Os caras malvados 2 - R$ 30,00</option>
              <option value="Quarteto Fantastico: Primeiros Passos - R$ 25,00">Quarteto Fantastico - R$ 25,00</option>
              <option value="Uma sexta-feira muito mais louca ainda - R$ 32,00">Uma sexta-feira muito mais louca ainda - R$ 32,00</option>
              <option value="Avatar: Fogo e Cinza - R$ 35,00">Avatar: Fogo e Cinza - R$ 35,00</option>
            </select>
          </div>

          <div class="campo">
            <label>Meia-Entrada:</label>
            <p class="info">Se tiver direito, pagará apenas 50% no ingresso.</p>
            <div class="opcoes">
              <label><input type="radio" name="tipoPessoa" value="Estudante"> Estudante</label>
              <label><input type="radio" name="tipoPessoa" value="Idosos (acima de 60 anos)"> Idoso (60+)</label>
              <label><input type="radio" name="tipoPessoa" value="Outros"> Outros</label>
              <label><input type="radio" name="tipoPessoa" value="Não sou beneficiário"> Não tenho</label>
            </div>
          </div>

          <div class="campo">
            <label>Comidas:</label>
            <div class="opcoes">
              <label><input type="checkbox" value="Pipoca pequena: R$ 28,00" name="comida[]"> Pipoca pequena - R$ 28,00</label>
              <label><input type="checkbox" value="Pipoca média: R$ 35,50" name="comida[]"> Pipoca média - R$ 35,50</label>
              <label><input type="checkbox" value="Pipoca grande: R$ 40,00" name="comida[]"> Pipoca grande - R$ 40,00</label>
              <label><input type="checkbox" value="Chocolate: R$ 20,00" name="comida[]"> Chocolate - R$ 20,00</label>
              <label><input type="checkbox" value="Nachos com queijo: R$ 38,80" name="comida[]"> Nachos - R$ 38,80</label>
            </div>
          </div>

          <div class="campo">
            <label>Bebidas:</label>
            <div class="opcoes">
              <label><input type="checkbox" value="Água: R$ 7,00" name="bebida[]"> Água - R$ 7,00</label>
              <label><input type="checkbox" value="Refrigerante: R$ 14,00" name="bebida[]"> Refrigerante - R$ 14,00</label>
              <label><input type="checkbox" value="Suco: R$ 12,00" name="bebida[]"> Suco - R$ 12,00</label>
            </div>
          </div>

          <div class="botao-centro">
            <button type="submit">Finalizar Compra</button>
          </div>
        </form>
      </fieldset>

      <!-- Resumo -->
      <?php 
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $cliente = $_POST['nomeCliente'];
          $filme= $_POST['tipoFilme'];
          $meiaEntrada = $_POST ['tipoPessoa'] ?? "Não informado";
          $comida = $_POST['comida'] ?? [];
          $bebida = $_POST['bebida'] ?? [];
          $total =0;

          if ($filme === "Os caras malvados 2 - R$ 30,00") $total += 30.00;
          if ($filme === "Quarteto Fantastico: Primeiros Passos - R$ 25,00") $total += 25.00;
          if ($filme === "Uma sexta-feira muito mais louca ainda - R$ 32,00") $total += 32.00;
          if ($filme === "Avatar: Fogo e Cinza - R$ 35,00") $total += 35.00;

          foreach ($comida as $item) {
              if ($item == 'Pipoca pequena: R$ 28,00') $total += 28.00;
              if ($item == 'Pipoca média: R$ 35,50')   $total += 35.50;
              if ($item == 'Pipoca grande: R$ 40,00')  $total += 40.00;
              if ($item == 'Chocolate: R$ 20,00')      $total += 20.00;
              if ($item == 'Nachos com queijo: R$ 38,80') $total += 38.80;
          }

          foreach ($bebida as $item) {
              if ($item == 'Água: R$ 7,00')          $total += 7.00;
              if ($item == 'Refrigerante: R$ 14,00') $total += 14.00;
              if ($item == 'Suco: R$ 12,00')         $total += 12.00;
          }

          if ($meiaEntrada !== "Outros" && $meiaEntrada !== "Não sou beneficiário" && $meiaEntrada !== "Não informado") {
              if ($filme === "Os caras malvados 2 - R$ 30,00") $total -= 15.00;
              if ($filme === "Quarteto Fantastico: Primeiros Passos - R$ 25,00") $total -= 12.50;
              if ($filme === "Uma sexta-feira muito mais louca ainda - R$ 32,00") $total -= 16.00;
              if ($filme === "Avatar: Fogo e Cinza - R$ 35,00") $total -= 17.50;
          }

          echo "<div class='resumo'><h2>Resumo da Compra</h2>";
          echo "<p><b>Cliente:</b> $cliente</p>";
          echo "<p><b>Filme:</b> $filme</p>";
          echo "<p><b>Meia-Entrada:</b> $meiaEntrada</p>";

          if (!empty($comida)) {
              echo "<p><b>Comidas:</b></p>";
              foreach ($comida as $c) echo "<p>- $c</p>";
          }

          if (!empty($bebida)) {
              echo "<p><b>Bebidas:</b></p>";
              foreach ($bebida as $b) echo "<p>- $b</p>";
          }

          echo "<p class='total'><b>Total a Pagar:</b> R$ " . number_format($total, 2, ',', '.') . "</p>";
          echo "</div>";
      }
      ?>
    </div>
  </div>
</body>
</html>
