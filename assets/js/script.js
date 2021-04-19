document.addEventListener("DOMContentLoaded", () => {
    const namedaysSubmit = document.getElementById("namedays-submit");
    const namesSubmit = document.getElementById("names-submit");
    const holidaysSubmit = document.getElementById("holidays-submit");
    const memorialsSubmit = document.getElementById("memorials-submit");
    const createSubmit = document.getElementById("create-submit");

    let request;

    namedaysSubmit.addEventListener("click", () => {
        const nameday = document.getElementById("nameday");
        const namedaysResponse = document.getElementById("namedays-response");
        const url = '/namedays/api/days/' + nameday.value;

        request = new Request(url, {
            method: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        });
        fetch(request)
            .then((response) => response.json())
            .then((data) => {
                alert(JSON.stringify(data));

                console.log(data);
            });
    });

    namesSubmit.addEventListener("click", () => {
        const name = document.getElementById("name");
        const namesCountry = document.getElementById("names-country");
        const namesResponse = document.getElementById("names-response");
        const url = '/namedays/api/names/' + name.value + '/countries/' + namesCountry.value;

        request = new Request(url, {
            method: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        });
        fetch(request)
            .then((response) => response.json())
            .then((data) => {
                alert(JSON.stringify(data));

                console.log(data);
            });
    });

    holidaysSubmit.addEventListener("click", () => {
        const holidaysCountry = document.getElementById("holidays-country");
        const url = '/namedays/api/countries/' + holidaysCountry.value + '/holidays';

        request = new Request(url, {
            method: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        });
        fetchRequest(request);
    });

    memorialsSubmit.addEventListener("click", () => {
        const url = '/namedays/api/memorials';

        request = new Request(url, {
            method: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        });
        fetch(request)
            .then((response) => response.json())
            .then((data) => {
                alert(JSON.stringify(data));

                console.log(data);
            });    })

    createSubmit.addEventListener("click", () => {
        const createDay = document.getElementById("create-day");
        const createName = document.getElementById("create-name");

        const url = '/namedays/api/names'
        request = new Request(url, {
            method: 'POST',
            body: JSON.stringify({
                name: createName.value,
                day: createDay.value,
            }),
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        })

        fetch(request)
            .then((response) => response.json())
            .then((data) => {
                alert(JSON.stringify(data));

                console.log(data);
            });
    })
});
