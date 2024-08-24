import FoodCard from "../../../components/FoodCard/FoodCard";
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import 'swiper/css/pagination';
import { Pagination } from 'swiper/modules';
import './OrderTab.css';

const OrderTab = ({ items }) => {
    // pagination 
    // 1. depend on total data & how many data show in each page make button & show selected button 
    // 2. click on a page number depend slice start from skip prev pages & show number of data want to show & check if end near reach or not

    // Function to chunk the data array into subarrays of a specific size

    const chunkArray = (array, chunkSize) => {
        const result = [];
        for (let i = 0; i < array.length; i += chunkSize) {
            result.push(array.slice(i, i + chunkSize));
        }
        return result;
    };

    // Chunk data into arrays of 6 items each
    const chunkedData = chunkArray(items, 6);

    const pagination = {
        clickable: true,
        renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + '</span>';
        },
    };

    return (
        <>
            <Swiper
                pagination={pagination}
                modules={[Pagination]}
                className="mySwiper"
            >
                {
                    chunkedData.map((chunk, index) => (
                        <SwiperSlide key={index}>
                            <div className="grid grid-cols-3 gap-2">
                                {chunk.map((item) =>
                                    <FoodCard key={item._id} item={item} />)
                                }
                            </div>
                        </SwiperSlide>

                    ))}
            </Swiper>
        </>
    );
};

export default OrderTab;