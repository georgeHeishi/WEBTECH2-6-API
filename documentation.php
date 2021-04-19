<html lang="sk">
<head>
    <title>API - Meniny</title>
    <meta charset="UTF-8">
    <meta name="author" content="Juraj Lapčák">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link href="/namedays/assets/css/style.css" rel="stylesheet">
    <script src="/namedays/assets/js/script.js"></script>
</head>
<body>
<div class="container-fluid">
    <?php include(__DIR__ . "/partials/header.php"); ?>

    <div class="row mt-5">
        <div class="col-lg ">
            <main class="site-content">
                <div class="container-fluid">
                    <div class="row">
                        <h5>GET - Hľadanie menín na základe zadaného dňa</h5>
                        <p>https://wt98.fei.stuba.sk/namedays/api/days/:date</p>
                        <p>Example url: </p>
                        <p>https://wt98.fei.stuba.sk/namedays/api/days/01.01.</p>
                        <p>Example Response: </p>
                        <code>{"status":200,"message":"OK","data":{"values":[{"value":"Fruzsina","country":"HU"},{"value":"Mieczyslawa","country":"PL"},{"value":"Mieszka","country":"PL"},{"value":"Neujahr","country":"AT"},{"value":"Asd","country":"SK"}]}}</code>
                    </div>
                    <hr>
                    <div class="row">
                        <h5>GET - Hľadanie dňa menín na základe zadaného mena a štátu</h5>
                        <p>https://wt98.fei.stuba.sk/namedays/api/names/:name/countries/:country</p>
                        <p>Example url: </p>
                        <p>https://wt98.fei.stuba.sk/namedays/api/names/Juraj/countries/SK</p>
                        <p>Example Response: </p>
                        <code>{"status":200,"message":"OK","data":{"values":[{"day":24,"month":4}]}}</code>
                    </div>
                    <hr>
                    <div class="row">
                        <h5>GET - Hľadanie kolekcie sviatkov s dňom na Slovensku alebo v Česku</h5>
                        <p>https://wt98.fei.stuba.sk/namedays/api/countries/:country/holidays</p>
                        <p>Example url: </p>
                        <p>https://wt98.fei.stuba.sk/namedays/api/countries/SK/holidays</p>
                        <p>Example Response: </p>
                        <code>{
                            "status": 200,
                            "message": "OK",
                            "data": {
                            "values": [
                            {
                            "value": "Deň vzniku Slovenskej republiky",
                            "day": 1,
                            "month": 1
                            },
                            {
                            "value": "Zjavenie Pána (Traja králi a vianočný sviatok pravoslávnych kresťanov)",
                            "day": 6,
                            "month": 1
                            },
                            {
                            "value": "Sviatok práce",
                            "day": 1,
                            "month": 5
                            },
                            {
                            "value": "Deň víťazstva nad fašizmom",
                            "day": 8,
                            "month": 5
                            },
                            {
                            "value": "Sviatok svätého Cyrila a Metoda",
                            "day": 5,
                            "month": 7
                            },
                            {
                            "value": "Výročie Slovenského národného povstania",
                            "day": 29,
                            "month": 8
                            },
                            {
                            "value": "Deň ústavy Slovenskej republiky",
                            "day": 1,
                            "month": 9
                            },
                            {
                            "value": "Sedembolestná Panna Mária",
                            "day": 15,
                            "month": 9
                            },
                            {
                            "value": "Sviatok všetkých svätých",
                            "day": 1,
                            "month": 11
                            },
                            {
                            "value": "Deň boja za slobodu a demokraciu",
                            "day": 17,
                            "month": 11
                            },
                            {
                            "value": "Štedrý deň",
                            "day": 24,
                            "month": 12
                            },
                            {
                            "value": "Prvý sviatok vianočný",
                            "day": 25,
                            "month": 12
                            },
                            {
                            "value": "Druhý sviatok vianočný",
                            "day": 26,
                            "month": 12
                            }
                            ]
                            }
                            }</code>
                    </div>
                    <hr>
                    <div class="row">
                        <h5>GET - Hľadanie kolekcie pamätných dní s dňom na Slovensku</h5>
                        <p>https://wt98.fei.stuba.sk/namedays/api/memorials</p>
                        <p>Example url: </p>
                        <p>https://wt98.fei.stuba.sk/namedays/api/memorials</p>
                        <p>Example Response: </p>
                        <code>{
                            "status": 200,
                            "message": "OK",
                            "data": {
                            "values": [
                            {
                            "value": "Deň zápasu za ľudské práva",
                            "day": 25,
                            "month": 3
                            },
                            {
                            "value": "Deň nespravodlivo stíhaných",
                            "day": 13,
                            "month": 4
                            },
                            {
                            "value": "Výročie úmrtia M.R. Štefánika",
                            "day": 4,
                            "month": 5
                            },
                            {
                            "value": "Výročie Memoranda národa slovenského",
                            "day": 7,
                            "month": 6
                            },
                            {
                            "value": "Deň zahraničných Slovákov",
                            "day": 5,
                            "month": 7
                            },
                            {
                            "value": "Výročie Deklarácie o zvrchovanosti Slovenskej republiky",
                            "day": 17,
                            "month": 7
                            },
                            {
                            "value": "Deň Matice slovenskej",
                            "day": 4,
                            "month": 8
                            },
                            {
                            "value": "Deň prvého verejného vystúpenia Slovenskej národnej rady",
                            "day": 19,
                            "month": 9
                            },
                            {
                            "value": "Deň obetí Dukly",
                            "day": 6,
                            "month": 10
                            },
                            {
                            "value": "Deň černovskej tragédie",
                            "day": 27,
                            "month": 10
                            },
                            {
                            "value": "Deň narodenia Ľudovíta Štúra",
                            "day": 29,
                            "month": 10
                            },
                            {
                            "value": "Výročie Deklarácie slovenského národa",
                            "day": 30,
                            "month": 10
                            },
                            {
                            "value": "Deň reformácie",
                            "day": 31,
                            "month": 10
                            },
                            {
                            "value": "Deň vyhlásenia Slovenska za samostatnú cirkevnú provinciu",
                            "day": 30,
                            "month": 12
                            }
                            ]
                            }
                            }</code>
                    </div>
                    <hr>
                    <div class="row">
                        <h5>POST - Vloženie mena do kalendára k slovenským menám</h5>
                        <p>https://wt98.fei.stuba.sk/namedays/api/names</p>
                        <p style="float: left;">Body:</p>
                        <pre style="margin-left: 60px">
name: :name
day: :day
                        </pre>
                        <p style="float: left;">ExampleBody:</p>
                        <pre style="margin-left: 60px">
name: 'Juraj'
day: '01.01.'
                        </pre>
                    </div>
                    <hr>
                </div>
            </main>
        </div>
    </div>
</div>

<?php include(__DIR__ . "/partials/footer.php"); ?>
</body>