import { useState } from "react";
import { DateRangePicker, Button, ButtonToolbar, Checkbox, Loader } from "rsuite";
import "rsuite/dist/rsuite.css";

const { allowedMaxDays, afterToday, combine } = DateRangePicker;
const LaySync = ({LoaderHandler}) => (
    <div 
      className="absolute top-0 left-0 w-full h-full cursor-pointer"
      onClick={ () => LoaderHandler()}
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

  async function LoaderHandler() {
    setSpinner(true)
    await fetch('https://jsonplaceholder.typicode.com/todos/1')
      .then(response => response.json())
      .then(json => console.log(json))
    setCheck(true)
    setSpinner(false)
  }

  function resetStates() {
    setCheck(false)
    setSpinner(false)
  }
  
  return (
    <div className="pt-5">
      <div className="flex gap-8 justify-center items-center flex-wrap">
        <DateRangePicker
          shouldDisableDate={combine(allowedMaxDays(7), afterToday())}
        />

        <ButtonToolbar>
          <Button color="cyan" appearance="primary">
            Reset
          </Button>
          <Button color="blue" appearance="primary">
            Send
          </Button>
        </ButtonToolbar>
      </div>

      <div className="flex items-center ">
        <div className="relative">
          <Checkbox checked={check ? true : false} onClick={()=> resetStates()} >sync</Checkbox>

          { spinner  &&(  <ElLoader />) }
          { !(check && !spinner ) && ( <LaySync LoaderHandler={LoaderHandler}/>) }
        </div>
      </div>
    </div>
  );
}

export default HeaderContent;