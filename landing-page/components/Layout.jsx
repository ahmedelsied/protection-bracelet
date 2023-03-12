import Head from "next/head";
import { Navbar } from ".";
import Image from 'next/image'

import Img1 from '../public/points_buttom.png'
import Img2 from '../public/star_sm.png'
import Img3 from '../public/star_big.png'
import Img4 from '../public/points_right.png'
import Img5 from '../public/points_top.png'

export default function Layout({ children }) {

    const imgElements = [
      {src: Img1, alt: 'points_buttom', class: 'max-sm:hidden'},
      {src: Img2, alt: 'star_sm', class: ''},
      {src: Img3, alt: 'star_big', class: ''},
      {src: Img4, alt: 'points_right', class: ''},
      {src: Img5, alt: 'points_top', class: ''},
  
  ]

  return (
    <div className='relative shadow-circle max-w-[1440px] m-auto overflow-x-hidden'>
      <Head>
        <meta name="description" content="protection bracelet for children" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
    
      <header className="sticky z-30 h-32">
        <Navbar />
      </header>

      <div className='grid min-h-[775px] h-screen absolute top-0 left-0 w-[1440px] z-10 select-none'>
              <div className='relative'> 
              {
                imgElements.map((element,i) => {
                  return (
                    <div className='absolute h-full' key={i}>
                      <Image src={element.src} className={`${element.class} object-contain h-full`} alt={element.alt}/>
                    </div>
                  )
                })
              }
              </div>
      </div>

      <main className=" min-h-[647px] h-[calc(100vh-128px)] grid content-center">
        {children}
      </main>
    </div>
  );
}
