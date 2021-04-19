document.addEventListener("DOMContentLoaded", () => {
    const namedaysSubmit = document.getElementById("namedays-submit");
    const namesSubmit = document.getElementById("names-submit");
    const holidaysSubmit = document.getElementById("holidays-submit");
    const memorialsSubmit = document.getElementById("memorials-submit");
    const createSubmit = document.getElementById("create-submit");

    let request;

    namedaysSubmit.addEventListener("click", () => {
        const nameday = document.getElementById("nameday");
        const namedaysCountry = document.getElementById("namedays-country");
        const url = '/namedays/api/days/' + nameday.value + '/countries/' + namedaysCountry.value;

        request = createRequest(url,'GET');
        fetchRequest(request);
    });

    namesSubmit.addEventListener("click", () => {
        const name = document.getElementById("name");
        const namesCountry = document.getElementById("names-country");
        const url = '/namedays/api/names/' + name.value + '/countries/' + namesCountry.value;

        request = createRequest(url,'GET');
        fetchRequest(request);
    });

    holidaysSubmit.addEventListener("click", () => {
        const holidaysDay = document.getElementById("holidays-day");
        const holidaysCountry = document.getElementById("holidays-country");
        const url = '/namedays/api/days/' + holidaysDay.value + '/countries/' + holidaysCountry.value + '/holidays';

        request = createRequest(url,'GET');
        fetchRequest(request);
    });

    memorialsSubmit.addEventListener("click", () => {
        const memorialsDay = document.getElementById("memorials-day");
        const url = '/namedays/api/days/' + memorialsDay.value + '/memorials';

        request = createRequest(url,'GET');
        fetchRequest(request);
    })

    createSubmit.addEventListener("click", () => {
        const createDay = document.getElementById("create-day");
        const createName = document.getElementById("create-name");
        // const url = '/namedays/api.php/names/' + createName.value + '/namedays/' + createDay.value;

        const url = '/namedays/api/names'
        request = new Request(url,{
            method: 'POST',
            body: JSON.stringify({
                name: createName.value,
                day: createDay.value,
            }),
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        })

        fetchRequest(request);
    })

    function createRequest(url, method){
        return new Request(url, {
            method: method,
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        });
    }

    function fetchRequest(request){
        fetch(request)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                document.getElementById("response").innerText = data;
            });
    }
});
