import DataConversionClass from "./DataConversionClass";

function fakeDataSync (){
    let d = new Date();
        d.getHours();
        d.getMinutes();
        d.getSeconds();
    let latitude= `12.${(Math.random()).toString().split('.')[1]}`
    let longitude= `77.${(Math.random()).toString().split('.')[1]}`

    return {

        "value": true,
        "data": [
        {
            "since": "2023-05-05",
            "times": [
            {
                "id": 1,
                "heart_beats_rate": (Math.random() * 100),
                "temperature_rate": (Math.random() * 70),
                "latitude": Number(latitude),
                "longitude": Number(longitude),
                "time": `${d.getHours()}:${d.getMinutes()}:${d.getSeconds()}`
            }
            ]
        }
        ],
        "code": 200
    }
}

class ApiClass {
    constructor(){
        this.host = 'http://192.168.219.20/api'
    }
    async apiInitialRequest() {

        const [from , to] = DataConversionClass.formatDateHandler(new Date())
        const filterRequest = await  this.apiFilterRequest(from, to);
        const data = DataConversionClass.conversionHandler(filterRequest);
        return data
    }

    async apiFilterRequest(from,to) {

        const res = await fetch(
            `${this.host}/child/bracelet/1/filter?from=${from}&to=${to}`
            ).then((res) => res.json() )

        return res;
    }

    async apiSyncRequest() {

        const res = await fetch(
            `${this.host}/child/bracelet/1/sync`
        ).then((res) => res.json());

        // const res = fakeDataSync()
        return res;
    }

}

export default new ApiClass
