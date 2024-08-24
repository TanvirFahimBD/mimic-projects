// Import Swiper React components
import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';
import './Category.css';
import slide1 from '../../../assets/home/slide1.jpg';
import slide2 from '../../../assets/home/slide2.jpg';
import slide3 from '../../../assets/home/slide3.jpg';
import slide4 from '../../../assets/home/slide4.jpg';
import slide5 from '../../../assets/home/slide5.jpg';
import SectionHeader from '../../../components/SectionHeader/SectionHeader';

const Category = () => {
    return (
        <>
            <SectionHeader subHeading="Order Now" Heading="Our Latest Dishes" />
            <Swiper
                slidesPerView={4}
                spaceBetween={30}
                centeredSlides={true}
                pagination={{
                    clickable: true,
                }}
                modules={[Pagination]}
                className="m-10 mySwiper"
            >
                <SwiperSlide>
                    <div className="d-flex">
                        <img src={slide1} alt="profile" />
                        <p className='-mt-24 text-3xl text-slate-10'>Salad</p>
                    </div>
                </SwiperSlide>

                <SwiperSlide>
                    <div className="d-flex">
                        <img src={slide2} alt="profile" />
                        <p className='-mt-24 text-3xl text-slate-10'>Pizza</p>
                    </div>

                </SwiperSlide>

                <SwiperSlide>
                    <div className="d-flex">
                        <img src={slide3} alt="profile" />
                        <p className='-mt-24 text-3xl text-slate-10'>Soup</p>
                    </div>
                </SwiperSlide>

                <SwiperSlide>
                    <div className="d-flex">
                        <img src={slide4} alt="profile" />
                        <p className='-mt-24 text-3xl text-slate-10'>Cake</p>
                    </div>
                </SwiperSlide>

                <SwiperSlide>
                    <div className="d-flex">
                        <img src={slide5} alt="profile" />
                        <p className='-mt-24 text-3xl text-slate-10'>Vagetables</p>
                    </div>

                </SwiperSlide>

            </Swiper>
        </>
    );
};

export default Category;