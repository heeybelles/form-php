<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="quiz.css">
<title>Quiz PHP</title>
</head>
<body>
<fieldset class="container">


<?php
$temas = ["Geografia", "Matemática", "Tecnologia"];
$quiz = [
    "Geografia" => [
        [
            'pergunta'=>"1. Qual é a capital da França?", 
            'opcoes'=>["A) Berlim","B) Madrid","C) Paris","D) Roma"], 
            'resposta'=>"C) Paris"
        ],

        [
            'pergunta'=>"2. Qual é o maior oceano do mundo?", 
            'opcoes'=>["A) Atlântico","B) Índico","C) Ártico","D) Pacífico"],
            'resposta'=>"D) Pacífico"
        ],

        [
            'pergunta'=>"3. Qual é o rio mais longo do mundo?",
            'opcoes'=>["A) Nilo","B) Amazonas","C) Yangtzé","D) Mississipi"],
            'resposta'=>"B) Amazonas"
        ],

        [ 
            'pergunta'=>"4. Qual país é conhecido como a Terra do Sol Nascente?", 
            'opcoes'=>["A) China","B) Japão","C) Coreia do Sul","D) Tailândia"],
            'resposta'=>"B) Japão"
        ],

        [
            'pergunta'=>"5. Qual é a maior floresta tropical do mundo?", 
            'opcoes'=>["A) Floresta do Congo","B) Floresta Amazônica","C) Floresta de Bornéu","D) Floresta de Daintree"],
            'resposta'=>"B) Floresta Amazônica"]
    ],
    "Matemática" => [
        [
            'pergunta'=>
             "1. Qual é o valor de π (pi) arredondado para duas casas decimais?", 
             'opcoes'=>["A) 3.12","B) 3.14","C) 3.16","D) 3.18"], 
             'resposta'=>"B) 3.14"
        ],

        [
            'pergunta'=>"2. Qual é a fórmula para calcular a área de um círculo?", 
            'opcoes'=>["A) A = πr²","B) A = 2πr","C) A = πd","D) A = r²"], 
            'resposta'=>"A) A = πr²"
        ],

        [
            'pergunta'=>"3. Qual é o próximo número na sequência: 2, 4, 8, 16, ___?",
            'opcoes'=>["A) 18","B) 20","C) 32","D) 64"], 
            'resposta'=>"C) 32"
        ],

        [
            'pergunta'=>"4. Qual é o valor de x na equação 2x + 5 = 15?", 
            'opcoes'=>["A) 3","B) 4","C) 5","D) 6"], 
            'resposta'=>"C) 5"
        ],

        [
            'pergunta'=>"5. Qual é a raiz quadrada de 81?", 
            'opcoes'=>["A) 7","B) 8","C) 9","D) 10"], 
            'resposta'=>"C) 9"
        ]
    ],

    "Tecnologia" => [
        [
            'pergunta'=>"1. O que significa a sigla 'HTTP'?", 
            'opcoes'=> ["A) HyperText Transfer Protocol","B) HyperText Transmission Protocol","C) HighText Transfer Protocol","D) HyperTransfer Text Protocol"], 
            'resposta'=>"A) HyperText Transfer Protocol"
        ],

        [
             'pergunta'=>"2. Qual empresa desenvolveu o sistema operacional Windows?",
             'opcoes'=>["A) Apple","B) Google","C) Microsoft","D) IBM"], 
             'resposta'=>"C) Microsoft"
        ],

        [
            'pergunta'=>"3. O que é um 'byte'?", 
            'opcoes'=>["A) Uma unidade de armazenamento de dados","B) Um tipo de processador","C) Um programa de computador","D) Um dispositivo de entrada"], 
            'resposta'=>"A) Uma unidade de armazenamento de dados"
        ],

        [
            'pergunta'=>"4. Qual é a função principal do software antivírus?", 
            'opcoes'=>["A) Acelerar o computador","B) Proteger contra malware e vírus","C) Melhorar a qualidade gráfica","D) Gerenciar arquivos"], 
            'resposta'=>"B) Proteger contra malware e vírus"
        ],

        [
            'pergunta'=>"5. O que significa a sigla 'AI' na área de tecnologia?", 
            'opcoes'=>["A) Artificial Intelligence","B) Automated Interface","C) Advanced Integration","D) Applied Information"],
            'resposta'=>"A) Artificial Intelligence"
        ]
    ]
];
?>

<form action="#" method="post">
<?php
if(isset($_POST['resposta']) && isset($_POST['tema'])){
    $tema = $_POST['tema'];
    $respostasUsuario = $_POST['resposta'];
    $acertos = 0;
    foreach($quiz[$tema] as $i => $questao){
        if(isset($respostasUsuario[$i]) && $respostasUsuario[$i]==$questao['resposta']) $acertos++;
    }
    echo "<fieldset class='resultado'><h3>Você acertou $acertos de 5 perguntas!</h3>";
    echo '<input type="submit" value="Refazer Quiz"></fieldset>';
} elseif(isset($_POST['tema'])){
    $tema = $_POST['tema'];
    echo "<legend>Quiz de $tema</legend>";
    foreach($quiz[$tema] as $i => $questao){
        echo "<fieldset class='questao'><p>".$questao['pergunta']."</p>";
        foreach($questao['opcoes'] as $opcao){
            echo "<label><input type='radio' name='resposta[$i]' value='$opcao'> $opcao</label><br>";
        }
        echo "</fieldset><br>";
    }
    echo "<input type='hidden' name='tema' value='$tema'>";
    echo "<input type='submit' value='Enviar Respostas'>";
} else {
    echo "<fieldset class='tema'><p>Escolha um tema:</p>";
    echo '<select name="tema">';
    foreach($temas as $t){ echo "<option value='$t'>$t</option>"; }
    echo '</select><br><br>';
    echo '<input type="submit" value="Iniciar Quiz"></fieldset>';
}
?>
</form>
</fieldset>
</body>
</html>
