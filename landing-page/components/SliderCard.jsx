import Image from "next/image";
import { useRef } from "react";

export default function SliderCard({cards}) {
  const refSider = useRef()
  const refAnimate = useRef()

  let circles = []
  let valAnimate = [-40,0,40]

  const activeHandler = (i) => {
    let slider = refSider.current
    let scrollWidthSlider = slider.scrollWidth
    let offSetSlider = scrollWidthSlider / circles.length
    refAnimate.current.style.transform = `translateX(${valAnimate[i]}px)`
    slider.style.transform = `translateX(${- offSetSlider * i}px)`
  }

  const createCircleHandler = () => {
    return circles?.map( (circle) =>  (
      <div key={circle} className='cursor-pointer rounded-3xl w-5 h-5 bg-slate-50' onClick={()=> activeHandler(circle)}></div>
    ))
  }

  return (
    <>
      <div className={`relative overflow-x-hidden bg-[rgb(22,22,22)] m-auto border-white border-2 rounded-lg`} onClick={(e)=>  e.stopPropagation()}>
        <div className="flex w-[70vw] h-[70vh] transform duration-500 ease-in-out" ref={refSider}>
          {
            cards?.map(({ img, title, text } ,index) => { {circles[index] = index}
              return (
                <div key={title} className=" px-5 py-5 grid md:gap-10 md:grid-cols-2 shrink-0 w-full items-center">
                  <div className="">
                    <p className=" " style={{fontSize: 'calc(18px + 1vw)'}}>{title}</p>
                    <p className="text-lg max-md:py-9 md:pt-12 " style={{fontSize: 'calc(10px + 0.5vw)'}}>{text}</p>
                  </div>
                  <div className="relative" style={{height: 'calc(200px + 20vmin)'}}>
                    <Image
                      className=""
                      alt="Medium card"
                      src={img}
                      fill
                    />
                  </div>
                </div>
            )})
          }
        </div>
      </div>
    <div className="relative flex mt-5 justify-center gap-5 py-4" onClick={(e)=>  e.stopPropagation()}>
      <div className="absolute rounded-3xl w-5 h-5 transition duration-500 ease-in-out bg-[#55043ab8] -translate-x-10" ref={refAnimate}></div>
      { createCircleHandler() }
    </div>

    </>
  );
}
