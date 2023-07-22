<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
        }

        .topnav {
            overflow: hidden;
            background-color: #14171a;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1;
        }

        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #14171a;
            color: #1E90FF;
        }

        .topnav a.active {
            background-color: #14171a;
            color: white;
            font-weight: bold;
        }

        .topnav .icon {
            display: none;
        }

        @media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {
                display: none;
            }

            .topnav a.icon {
                float: right;
                display: block;
            }
        }

        @media screen and (max-width: 600px) {
            .topnav.responsive {
                position: relative;
            }

            .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
            }

            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
            }
        }

        input[type=text],
        select {
            width: 100%;
            padding: 12px 12px;
            margin: 8px 0;
            display: block;
            border: 1px solid #1872d9;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 18px;
        }

        input[type=submit] {
            width: 100%;
            background-color: #40b854;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #369e47;
        }

        input[type=button] {
            width: 100%;
            background-color: #1E90FF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=button]:hover {
            background-color: #1872d9;
        }

        div.container {
            max-width: 400px;
            margin: 0 auto;
            border-radius: 5px;
            background-color: white;
            padding: 20px;
            margin-bottom: 50px;
        }

        h2 {
            margin-top: 100px;
            text-align: center;
            color: #081b30;
        }

        label {
            font-size: 14px;
            color: #081b30;
        }

        p {
            text-align: center;
        }

        footer {
            background-color: #14171a;
            color: #fff;
            text-align: center;
            padding: .05rem;
        }
    </style>
</head>

<body>

    <div class="topnav" id="myTopnav">
        <a href="#" class="active">yLess Store</a>
        <a href="index.php">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <h2>Hitung Winrate Mobile Legends</h2>
    <div class="container">
        <form onsubmit="return calculateTotalMatches(event)">
            <label for="totalp">Total Pertandingan Anda</label>
            <input required type="text" inputmode="numeric" id="ltotalp" name="totalp" placeholder="Contoh : 141"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')">

            <label for="wr">Winrate Anda Saat ini</label>
            <input required type="text" inputmode="numeric" id="lwrsekarang" name="wrsekarang"
                placeholder="Contoh : 46.2%" oninput="this.value = this.value.replace(/[^0-9,.]/g, '')">

            <label for="wrhasil">Winrate yang Anda Inginkan</label>
            <input required type="text" inputmode="numeric" id="lwrhasil" name="wrhasil" placeholder="Contoh : 75%"
                oninput="this.value = this.value.replace(/[^0-9,.]/g, '')">

            <input type="submit" value="Cek Sekarang">
        </form>
        <p id="resultMessage" style="display: none;"></p>
        <br>
        <a href="hitungmw.php">
            <input type="button" value="Hitung Point Magic Wheel">
        </a>
        <br>
        <br>
        <a href="hitungzodiac.php">
            <input type="button" value="Hitung Point Skin Zodiac">
        </a>
    </div>
    </div>
    <footer>
        <p>Copyright &copy; 2023 yLess Store All Rights Reserved.</p>
    </footer>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
        function calculateTotalMatches(event) {
            event.preventDefault();

            const pS = parseFloat(document.getElementById('ltotalp').value);
            const wS = parseFloat(document.getElementById('lwrsekarang').value.replace(',', '.'));
            const wI = parseFloat(document.getElementById('lwrhasil').value.replace(',', '.'));
            const jM = (wS / 100) * pS;
            const tM = ((wI * pS) - (100 * jM)) / (100 - wI);
            const roundedTM = Math.round(tM);
            const resultMessage = document.getElementById('resultMessage');
            
            resultMessage.style.display = 'block';

            if (wI > 100) {
                resultMessage.innerHTML = "<strong>Ngotak dikit lah kalau minta!</strong>";
            } else if (wI === 0) {
                resultMessage.innerHTML = "<strong>Ngotak dikit lah kalau minta!</strong>";
            } else if (tM === Infinity) {
                resultMessage.innerHTML = "<strong>Ngotak dikit lah kalau minta!</strong>";
            } else if (roundedTM == 0) {
                resultMessage.innerHTML = "Win Rate yang kamu inginkan sudah tercapai.";
            } else if (tM < 0) {
                const absRoundedTM = Math.abs(roundedTM);
                resultMessage.innerHTML = `Kamu membutuhkan sekitar <strong>${absRoundedTM}</strong> kekalahan beruntun untuk mendapatkan Win Rate <strong>${wI}%</strong>.`;
            } else {
                resultMessage.innerHTML = `Kamu membutuhkan sekitar <strong>${roundedTM}</strong> pertandingan tanpa kalah untuk mendapatkan Win Rate <strong>${wI}%</strong>.`;
            }
            return false;
        }
    </script>
</body>

</html>
