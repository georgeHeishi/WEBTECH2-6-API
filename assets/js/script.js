document.addEventListener("DOMContentLoaded", () => {
    console.log("hello world");
    const namedaysSubmit = document.getElementById("namedays-submit");
    const namesSubmit = document.getElementById("names-submit");
    const holidaysSubmit = document.getElementById("holidays-submit");
    const memorialsSubmit = document.getElementById("memorials-submit");

    let request;

    namedaysSubmit.addEventListener("click", () => {
        console.log("namedaysSubmit click");

        const nameday = document.getElementById("nameday");
        const namedaysCountry = document.getElementById("namedays-country");
        const url = '/namedays/api.php/namedays/' + nameday.value + '/countries/' + namedaysCountry.value;

        request = createGetRequest(url);
        fetchRequest(request);
    });

    namesSubmit.addEventListener("click", () => {
        console.log("namesSubmit click");

        const name = document.getElementById("name");
        const namesCountry = document.getElementById("names-country");
        const url = '/namedays/api.php/names/' + name.value + '/countries/' + namesCountry.value;

        request = createGetRequest(url);
        fetchRequest(request);
    });

    holidaysSubmit.addEventListener("click", () => {
        console.log("holidaysSubmit click");

        const holidaysDay = document.getElementById("holidays-day");
        const holidaysCountry = document.getElementById("holidays-country");
        const url = '/namedays/api.php/days/' + holidaysDay.value + '/countries/' + holidaysCountry.value + '/holidays';

        request = createGetRequest(url);
        fetchRequest(request);
    });

    memorialsSubmit.addEventListener("click", () => {
        console.log("memorialsSubmit click");

        const memorialsDay = document.getElementById("memorials-day");
        const url = '/namedays/api.php/days/' + memorialsDay.value + '/memorials';

        request = createGetRequest(url);
        fetchRequest(request);
    })
});

function createGetRequest(url){
    return new Request(url, {
        method: 'GET',
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        }
    });
}

function fetchRequest(request){
    fetch(request)
        .then((response) => response.json())
        .then((data) => {
            console.log(data.status);
        });
}