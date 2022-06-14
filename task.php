<?php
if (isset($_POST['word'])) {
    setcookie("word", $_POST['word'], time() + 3600 * 60, false);
}

if (isset($_POST['question'])) {
    setcookie("question", $_POST['question'], time() + 3600 * 60, false);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet">
    <script crossorigin="anonymous"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
</head>
<body>

<script>

    var wordLength = getCookie("word").toString().length;
    var unveiledLettersAndStars = new Array(wordLength);

    var bids = 0;

    var word = new Array(wordLength);
    let tempWord = getCookie("word").toString();

    for (let i = 0; i < wordLength; i++) {
        word[i] = tempWord[i].toUpperCase();
    }

    for (let i = 0; i < wordLength; i++) {
        unveiledLettersAndStars[i] = '*'
    }
    function startNewGame() {
        window.location.replace("startNewGame.php");
    }

    function getCookie(cName) {
        const name = cName + "=";
        const cDecoded = decodeURIComponent(document.cookie);
        const cArr = cDecoded.split('; ');
        let res;
        cArr.forEach(val => {
            if (val.indexOf(name) === 0) res = val.substring(name.length);
        })
        return res
    }

    function isWholeWordUnveiled() {
        for (let i = 0; i < wordLength; i++) {
            if (unveiledLettersAndStars[i] === '*') {
                return false;
            }
        }
        return true;
    }

    function checkInput() {
        bids++;
        var letterOfWord = document.getElementById("wrdInpt").value.toUpperCase();
        letterOfWord.trim();

        if (bids === 20 && !isWholeWordUnveiled()) {
            alert("you lose. you can start new game");
            bids = 0;
            startNewGame();
        }
        if (letterOfWord.length > 1) {

            if (wordLength === letterOfWord.length) {
                for (let i = 0; i < wordLength; i++) {
                    if (word[i] === letterOfWord[i]) {
                        unveiledLettersAndStars[i] = word[i];
                    } else {
                        break;
                    }
                }
            }
            endOfGame();
        } else {
            for (let i = 0; i < wordLength; i++) {
                if (word[i] === letterOfWord) {
                    unveiledLettersAndStars[i] = word[i];
                }
            }
        }
        document.getElementById("word").innerHTML = unveiledLettersAndStars.toString();
        if (isWholeWordUnveiled()) {
            endOfGame();
        }

        document.getElementById("wrdInpt").value = "";
    }

    function endOfGame() {
        if (isWholeWordUnveiled()) {
            document.getElementById("word").innerHTML = (unveiledLettersAndStars.toString().concat(" Congrats, you won"));
            bids = 0;
        } else {
            alert("you lose. you can start new game");
            bids = 0;
            startNewGame();
        }
    }
</script>

<div class="container">

    <div>
        <div class="row">
            <h1>Капитал-шоу «По́ле чуде́с»</h1>
            <h1> — советская и российская телеигра, выходящая каждую пятницу в 19:45 и являющаяся частичным аналогом
                американской телевизионной программы «Колесо Фортуны».</h1><br>
            <h1>В этой игре вам нужно буде</h1>
            <h1>т угадать загаданное слово путем ответа на вопрос. В строчку нужно вводить только одну букву и после
                этого нажимать кнопку "угадать символ", чтобы проверить если эта буква в загаданном слове. После того
                как вы угадаете слово, оно появится целеком, а также выведется количество ваших попыток. Удачи!</h1>
        </div>

        <div class="row">
            <h1>Вопрос ниже:</h1><br>
            <h1 id="question"></h1>
        </div>

        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <h1 id="word" class=""></h1>
            </div>
            <div class="col-4"></div>
        </div>

        <div class="row">
            <div class="col-4"></div>

            <div class="col-4">
                <form class="form-control">
                    <label class="h3" for="wrdInpt">Here you can input letter or whole word</label>
                    <input name="wordLetter" class="form-control mt-4 mb-4" id="wrdInpt" type="text" placeholder="letter or whole word"/>


                </form>
                <button onclick="checkInput()" class="form-control btn btn-dark mt-4 mb-4">check my input out</button>

                <form class="form-control mt-4 mb-4 " action="startNewGame.php" method="post" >
                    <button class="form-control btn btn-dark" >start new game</button>
                </form>
            </div>

            <div class="col-4"></div>
        </div>


    </div>
    <script>
        document.getElementById("word").innerHTML = unveiledLettersAndStars.toString();
        document.getElementById("question").innerHTML = getCookie("question");
    </script>


</div>
</body>
</html>


