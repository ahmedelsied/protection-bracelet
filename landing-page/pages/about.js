import Image from 'next/image'

import Member1 from '../public/members/m1.png'
import Member2 from '../public/members/m2.png'
import Member3 from '../public/members/m3.png'
import Member4 from '../public/members/m4.png'
import Member5 from '../public/members/m5.png'
import Member6 from '../public/members/m6.png'
import Member7 from '../public/members/m7.png'
import Member8 from '../public/members/m8.png'
import Member9 from '../public/members/m9.png'
import Member10 from '../public/members/m10.png'

export default function About() {

  const members = [
    { img: Member1, name: 'Mohamed Saad', alt: 'mohamed' },
    { img: Member2, name: 'Ahmed Elsayed', alt: 'Ahmed' },
    { img: Member3, name: 'Ibrahim Mohamed', alt: 'Ibrahim' },
    { img: Member4, name: 'Khaled Ahmed', alt: 'Khaled ' },
    { img: Member5, name: 'Laurence Simon', alt: 'Laurence' },
    { img: Member6, name: 'Huw Thomas', alt: 'Huw' },
    { img: Member7, name: 'Shai Dromi', alt: 'Shai' },
    { img: Member8, name: 'Abhi Kumar', alt: 'Abhi' },
    { img: Member9, name: 'Shuo Li Liu', alt: 'Shuo' },
    { img: Member10, name: 'Michael Van Devere', alt: 'Michael' },
  ]

  return (
    <article className='z-20 sticky h-[615px]'>
      <section className='mb-9'>
        <div className='w-3/4 m-auto text-center border-b-2 border-[#aeaeae] pb-4'>
          <h2 className=' text-2xl my-3'>Protection Bracelet</h2>
          <p className=' w-4/5 m-auto p-4 text-[#aeaeae]'>Track your children,grandparents or whoecer you want now, easily and with a complete dashboard show live location, body temperature and heart beats minute by minute.Track your children,grandparents or whoecer you want now, easily and with a complete dashboard show live location, body temperature and heart beats minute by minute.</p>
        </div>
      </section>
      <section className='mb-3'>
        <div className='flex flex-wrap w-2/3 m-auto gap-10 justify-center text-center'>
          {
            members.map((member, i) => {
              return (
                <div className='h-32 w-24 my-2 rounded-md border-4 border-white' key={i}>
                  <Image src={member.img} className="h-full select-none" alt={member.alt} />
                  <span className='block text-xs mt-2'>{member.name}</span>
                </div>
              )
            })
          }
        </div>
      </section>
    </article>
  )
}
