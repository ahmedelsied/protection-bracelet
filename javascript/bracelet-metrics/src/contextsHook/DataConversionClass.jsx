class DataConversionClass {

    formatDateHandler (dateFrom , dateTo = 'default'){
      
      const date = dateFrom;
      const year =  date.getFullYear()
      const month =  date.getMonth() + 1
    
      const DayFrom = dateTo == 'default' ? date.getDate() - 7  : date.getDate()
      const DayTo = dateTo == 'default' ? date.getDate() : dateTo.getDate()

      const from = `${year}-${month}-${DayFrom}`
      const to = `${year}-${month}-${DayTo}`

      return [from , to]
    }

    conversionHandler(data) {

      let allData = [], manTrack = [], pointsSensor = [];
      data.data.forEach(obj => {

        let since = obj.since

        obj.times.forEach(item => {

          pointsSensor.push({
            date: `${since} ${item.time}`,
            heart_rate: item.heart_beats_rate,
            temp_sensor: item.temperature_rate,
          })

          manTrack.push({ lat: item.latitude, lng: item.longitude })

        });
      });

      allData = [manTrack,pointsSensor]
      return allData
    }
}

export default new DataConversionClass