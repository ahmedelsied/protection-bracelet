import { useState } from "react";
import { DateRangePicker, Button, ButtonToolbar, Checkbox, Loader } from "rsuite";
import "rsuite/dist/rsuite.css";
import PbvCtxEvents from '../contextsHook/pbvCtxEvents'
import DataConversionClass from "../contextsHook/DataConversionClass"
import ApiClass from "../contextsHook/ApiClass"

const { allowedMaxDays, afterToday, combine } = DateRangePicker;

const LaySync = ({checkedHandler}) => (
    <div
      className="absolute top-0 left-0 w-full h-full cursor-pointer"
      onClick={ () => checkedHandler()}
      >
    </div>
  )

const ElLoader = () => (
    <div className="absolute left-[9px] top-[9px]">
      <Loader/>
    </div>
  )

function HeaderContent() {
  const [spinner ,setSpinner] = useState(false)
  const [check,setCheck] = useState(false)
  const [{},start_Sync_Handler,stop_Sync_Handler,setDataFilter] =  PbvCtxEvents()

  let dateRange = []

  function checkedHandler() {
    setSpinner(true)
    start_Sync_Handler()
    setCheck(true)
    setSpinner(false)
  }

  function resetStates() {
    stop_Sync_Handler()
    setCheck(false)
    setSpinner(false)
  }

  function rangePickerHandler(e) {
    let from = e[0]
    let to = e[1]
    dateRange = DataConversionClass.formatDateHandler(from,to)
  }

  function sendHandler() {

    document.getElementsByClassName('rs-picker-toggle-clean')[0]?.click()

    if(dateRange.length != 0){
      ApiClass.apiFilterRequest(dateRange[0], dateRange[1]).then((res) => {
        dateRange = []
        const data  = DataConversionClass.conversionHandler(res)
        setDataFilter(data)
      })
    }else{
      console.log(dateRange);
    }
  }

  return (
    <div className="pt-5">
      <div className="flex gap-8 justify-center items-center flex-wrap">
        <DateRangePicker onOk={ (e) => rangePickerHandler(e) }
          shouldDisableDate={combine(allowedMaxDays(7), afterToday())}
        />

        <ButtonToolbar>
          <Button color="blue" appearance="primary" onClick={ () => sendHandler() }>
            Send
          </Button>
        </ButtonToolbar>
      </div>

      <div className="flex items-center ">
        <div className="relative">
          <Checkbox checked={check ? true : false} onClick={()=> resetStates()} >sync</Checkbox>

          { spinner  &&(  <ElLoader />) }
          { !(check && !spinner ) && ( <LaySync checkedHandler={checkedHandler}/>) }
        </div>
      </div>
    </div>
  );
}

export default HeaderContent;
