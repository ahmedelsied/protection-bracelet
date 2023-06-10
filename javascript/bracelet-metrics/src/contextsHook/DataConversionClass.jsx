class DataConversionClass {

    formatDateHandler (fromRange , toRange = 'default'){

        toRange = toRange == 'default' ? new Date : toRange;
        const date = fromRange;
        const day =  date.getDate() - 1
        const year =  date.getFullYear()
        const month =  date.getMonth() + 1

        const dateTo = toRange;
        const dayTo =  dateTo.getDate() + 1
        const yearTo =  dateTo.getFullYear()
        const monthTo =  dateTo.getMonth() + 1

      const from = `${year}-${month}-${day}`
      const to = `${yearTo}-${monthTo}-${dayTo}`

      return [from , to]
    }

    getDateToday() {
        const date = new Date();

        let currentDay= String(date.getDate()).padStart(2);

        let currentMonth = String(date.getMonth()+1).padStart(2);

        let currentYear = date.getFullYear();

        // we will display the date as DD-MM-YYYY

        return `${currentDay}-${currentMonth}-${currentYear}`;
    }

    conversionHandler(response) {

      let allData = [], manTrack = [], pointsSensor = [];
      console.log(response.data,typeof response.data);
      if(Array.isArray(response.data)){


        response.data?.forEach(obj => {

            let since = obj?.since ?? getToday();

            obj?.times?.forEach(item => {

            pointsSensor.push({
                date: `${since} ${item.time}`,
                heart_rate: item.heart_beats_rate,
                temp_sensor: item.temperature_rate,
            })

            manTrack.push({ lat: item.latitude, lng: item.longitude })

            });
        });
      }else{
        let obj = response.data;
        let since = obj?.since ?? getDateToday();
        let item = obj?.times;

        pointsSensor.push({
            date: `${since} ${item?.time}`,
            heart_rate: item?.heart_beats_rate,
            temp_sensor: item?.temperature_rate,
        })

        manTrack.push({ lat: item?.latitude, lng: item?.longitude })

      }
        allData = [manTrack,pointsSensor]
        return allData
    }
}

export default new DataConversionClass
