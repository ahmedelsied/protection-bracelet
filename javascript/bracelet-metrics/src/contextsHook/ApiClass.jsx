import DataConversionClass from "./dataConversionClass";



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
        this.globleData = [];
    }

    async apiInitialRequest(anyState) {

        const [from , to] = DataConversionClass.formatDateHandler(new Date())
        
        const data = await  this.apiFilterRequest(from, to);
        const [manTrack, pointsSensor] = DataConversionClass.conversionHandler(data);

        let stringify = anyState ? manTrack : pointsSensor;

        return stringify;

    }
    
    async apiFilterRequest(from,to) {

        const res = await fetch(
            `https://mega-two.vercel.app/fakeDataFilter.json`
            ).then((res) => res.json() )

        return res;
    }

    async apiSyncRequest() {
        
        // const res = await fetch(
        //     "{{protection-bracelet-host}}/child/bracelet/:bracelet/sync"
        // ).then((res) => res.json());

        const res = fakeDataSync()
        
        return res;
    }

}

export default new ApiClass