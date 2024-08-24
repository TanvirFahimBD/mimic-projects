import PageTitle from "../../../components/PageTitle/PageTitle";
import PopularMenu from "../../Home/PopularMenu/PopularMenu";
import coverImg from '../../../assets/menu/banner3.jpg'
import dessertImg from '../../../assets/menu/dessert-bg.jpeg';
import saladImg from '../../../assets/menu/salad-bg.jpg';
import pizzaImg from '../../../assets/menu/pizza-bg.jpg';
import soupImg from '../../../assets/menu/soup-bg.jpg';

const Menu = () => {
    return (
        <div>
            <PageTitle title="Menu | Bistro Boss" />

            {/* offered */}
            <PopularMenu coverImg={coverImg} category="offered" menuTitle="Offered Menu" menuInfo="bistro-boss / menu / offered" />

            {/* salad */}
            <PopularMenu coverImg={saladImg} category="salad" menuTitle="Salad Menu" menuInfo="bistro-boss / menu / salad" />

            { /* drinks */}
            <PopularMenu coverImg={coverImg} category="drinks" menuTitle="Drinks Menu" menuInfo="bistro-boss / menu / drinks" />

            {/* dessert */}
            <PopularMenu coverImg={dessertImg} category="dessert" menuTitle="Dessert Menu" menuInfo="bistro-boss / menu / dessert" />

            {/* pizza */}
            <PopularMenu coverImg={pizzaImg} category="pizza" menuTitle="Pizza Menu" menuInfo="bistro-boss / menu / pizza" />

            {/* soup */}
            <PopularMenu coverImg={soupImg} category="soup" menuTitle="Soup Menu" menuInfo="bistro-boss / menu / soup" />

        </div>
    );
};

export default Menu;