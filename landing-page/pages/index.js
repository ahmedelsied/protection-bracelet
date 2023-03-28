import { useEffect, useRef, useState } from 'react'
import Head from 'next/head'
import Image from 'next/image'
import Link from 'next/link'

import Img1 from '../public/circle.png'
import Img2 from '../public/watch.png'
import Img3 from '../public/circle_center.png'

import Style from '../styles/home.module.css'
import SliderCard from '@/components/SliderCard'

import Shar_data from '../public/shar_data.png'
import Map from '../public/map.png'
import Heart_Rate from '../public/heartRate.png'

export default function Home() {

  const [slider, setSlider] = useState(false)

  const imgElements = [
    {src: Img1, alt: 'circle', style: 'absolute h-full'},
    {src: Img2, alt: 'watch', style: `${Style.animation} h-full max-md:translate-x-[calc((50vw-440px))]`},
    {src: Img3, alt: 'circle_center', style: 'absolute h-full'},
]

  const imgsCard = [
    {img: Shar_data, title: 'Share data & lots of details to get complete reassurance', text: 'Track your children,grandparents or whoecer you want now, easily and with a complete dashboard show live location, body temperature and heart beats minute by minute.'},
    {img: Map, title: "Contains a location to track your child's path", text: 'Track your children,grandparents or whoecer you want now, easily and with a complete dashboard show live location, body temperature and heart beats minute by minute.'},
    {img: Heart_Rate, title: 'Equipped with vital systems to measure the heart and temperature', text: 'Track your children,grandparents or whoecer you want now, easily and with a complete dashboard show live location, body temperature and heart beats minute by minute.'}
  ]
  const refFade= useRef()

  let intervals = null

  const fadeOutHandler =  () => {
    refFade.current.style.opacity = 0
    intervals = setTimeout(() => { setSlider(false) }, 500)
  }

  useEffect( () => {
    if(slider)
      refFade.current.style.opacity = 1
    
    return () => clearInterval(intervals)
  },[slider])

  return (
    <>
      <Head>
        <title>Protection Bracelet</title>
      </Head>
      {
        slider && (
          <div className='content-center grid opacity-0 fixed w-full h-full top-0 left-0 bg-[#171115] z-50 transition duration-500 ease-in-out' ref={refFade} onClick={()=>fadeOutHandler()}>
            <SliderCard cards={imgsCard} />
          </div>
        )
      }

      <article className=''>
            <section className='grid min-h-[775px] h-screen absolute top-0 left-0 w-[1440px] z-10 select-none'>
              <div className='relative'> 
              {
                imgElements.map((element,i) => {
                  return (
                    <div className={element.style} key={i}>
                      <Image src={element.src} className="object-contain h-full" alt={element.alt}/>
                    </div>
                  )
                })
              }
              </div>
            </section>
            <section className='grid xl:grid-cols-[20%,auto] z-20 sticky h-[646px] max-xl:grid-rows-[13%,auto]'>
              <div className='pl-10'>
                <h2 className='w-24 pl-8 pt-6 text-lg'>Protection Bracelet</h2>
              </div>
              <div className='grid xl:grid-cols-[540px,180px] justify-end sm:grid-cols-[90%,auto] max-sm:grid-cols-1'>
                <div className=' pt-12 xl:self-center flex flex-col sm:max-xl:items-end max-sm:items-center'>
                  <h1 className=' text-8xl xl:text-[160px] font-kBlack text-center sm:max-xl:text-9xl'>PBV.0</h1>
                  <div className={`${Style.star} relative flex xl:justify-evenly select-none xl:ml-7 py-12 xl:border-2 xl:border-r-0 border-[#8319a0] rounded-l-full`}>
                    <div className='px-8 py-2 sm:px-11 rounded-3xl border-2 border-[#8319a0] cursor-pointer max-xl:mr-7' onClick={()=> setSlider(true)}> See More</div>
                    <Link className='px-8 py-2 sm:px-11 rounded-3xl border-2 border-[#8319a0] cursor-pointer' href="/contact">Shop now</Link>
                  </div>
                  <p className='w-9/12 xl:mt-6 xl:ml-10 font-kLight max-xl:max-w-[400px]'>Track your children,grandparents or whoecer you want now, easily and with a complete dashboard show live location, body temperature and heart beats minute by minute.</p>
                </div>
                <div className='max-sm:hidden border-t-2 border-l-2 max-xl:border-0 border-[#8319a0] rounded-t-full grid'>
                  <p className='-rotate-90 translate-y-[222px] h-max w-max'>Technology is the future</p>
                  <div className='flex items-center justify-center flex-wrap'>
                    <span className='w-full h-px'></span>
                    <p className='w-full h-[151px] border-t-2 max-xl:border-0 border-[#8319a0] pt-10 pr-10 pl-16'>We are Teach Lovers</p>
                  </div>
                </div>
              </div>
            </section>
      </article>
    </>
  )
}
