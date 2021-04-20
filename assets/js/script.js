document.addEventListener("DOMContentLoaded", () => {
    const namedaysSubmit = document.getElementById("namedays-submit");
    const namesSubmit = document.getElementById("names-submit");
    const holidaysSubmit = document.getElementById("holidays-submit");
    const memorialsSubmit = document.getElementById("memorials-submit");
    const createSubmit = document.getElementById("create-submit");

    let request;

    namedaysSubmit.addEventListener("click", () => {
        const nameday = document.getElementById("nameday");
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
                if (data.status === 200) {
                    const div = document.getElementById("namedays-response");
                    div.innerHTML = "";
                    data.data.values.forEach((index, value) => {
                        div.innerHTML += index.value + ": " + index.country + "<br>";
                    })
                } else {
                    const div = document.getElementById("namedays-response");
                    div.innerHTML = "";
                    div.innerText += data.message;
                }
                console.log(data);
            });
    });

    namesSubmit.addEventListener("click", () => {
        const name = document.getElementById("name");
        const namesCountry = document.getElementById("names-country");
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
                displayWithDate(data, "names-response");

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
        fetch(request)
            .then((response) => response.json())
            .then((data) => {
                displayWithDate(data, "holidays-response");

                console.log(data);
            });
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
                displayWithDate(data, "memorials-response");

                console.log(data);
            });
    })

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
                const div = document.getElementById("create-response");
                div.innerHTML += data.message;

                console.log(data);
            });
    })

    function displayWithDate(data, id) {
        if (data.status === 200) {
            const div = document.getElementById(id);
            div.innerHTML = "";
            data.data.values.forEach((index) => {
                let value = "";
                if (typeof index.value !== 'undefined') {
                    value = ": " + index.value;
                }
                div.innerHTML += index.day + ". " + index.month + ". " + value + "<br>";
            })
        } else {
            const div = document.getElementById(id);
            div.innerHTML = "";
            div.innerText += data.message;
        }
    }
});
