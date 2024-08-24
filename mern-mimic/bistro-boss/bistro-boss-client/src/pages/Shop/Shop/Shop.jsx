import { Tab, Tabs, TabList, TabPanel } from 'react-tabs';
import 'react-tabs/style/react-tabs.css';
import { useState } from "react";
import { useParams } from "react-router-dom";
import Cover from '../../Shared/Cover/Cover';
import useMenu from '../../../hooks/useMenu';
import bannerImg from '../../../assets/shop/banner2.jpg';
import OrderTab from '../OrderTab/OrderTab';

const Shop = () => {
    const { category } = useParams();
    const categories = ['salad', 'pizza', 'soup', 'dessert', 'drinks', 'offered', 'popular'];
    const initialIndex = categories.indexOf(category) > 0 ? categories.indexOf(category) : 0;

    const [menu, loading] = useMenu();
    const [tabIndex, setTabIndex] = useState(initialIndex);

    const salads = menu.filter(item => item.category == 'salad');
    const pizzas = menu.filter(item => item.category == 'pizza');
    const soups = menu.filter(item => item.category == 'soup');
    const desserts = menu.filter(item => item.category == 'dessert');
    const drinks = menu.filter(item => item.category == 'drinks');
    const offereds = menu.filter(item => item.category == 'offered');
    const populars = menu.filter(item => item.category == 'popular');

    if (loading) {
        return <p>Loading...</p>
    }

    return (

        <>
            <Cover img={bannerImg} menuTitle="Our Shop" menuInfo="bistro-boss / shop" />

            {/* tabs  */}
            <Tabs selectedIndex={tabIndex} onSelect={(index) => setTabIndex(index)} className="text-center">
                <TabList>
                    <Tab>Salad</Tab>
                    <Tab>Pizza</Tab>
                    <Tab>Soup</Tab>
                    <Tab>Desert</Tab>
                    <Tab>Drinks</Tab>
                    <Tab>Offered</Tab>
                    <Tab>Popular</Tab>
                </TabList>

                {/* Salad */}
                <TabPanel>
                    <OrderTab items={salads} />
                </TabPanel>

                {/* Pizza */}
                <TabPanel>
                    <OrderTab items={pizzas} />
                </TabPanel>

                {/* Soup */}
                <TabPanel>
                    <OrderTab items={soups} />
                </TabPanel>

                {/* Desert */}
                <TabPanel>
                    <OrderTab items={desserts} />
                </TabPanel>

                {/* Drinks */}
                <TabPanel>
                    <OrderTab items={drinks} />
                </TabPanel>

                {/* offereds */}
                <TabPanel>
                    <OrderTab items={offereds} />
                </TabPanel>

                {/* populars */}
                <TabPanel>
                    <OrderTab items={populars} />
                </TabPanel>

            </Tabs>
        </>
    );
};

export default Shop;