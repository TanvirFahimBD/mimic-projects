import { Parallax } from 'react-parallax';

const Cover = ({ img, menuTitle, menuInfo }) => {
    return (
        <Parallax
            blur={{ min: -15, max: 15 }}
            bgImage={img}
            bgImageAlt="the cover"
            strength={-200}
            className='my-5'
        >

            <div
                className="hero h-[300px]">
                <div className="hero-overlay bg-opacity-60"></div>
                <div className="px-40 py-10 text-center bg-black px-30 bg-opacity-30 hero-content text-neutral-content">
                    <div className="max-w-md">
                        <h1 className="mb-5 text-5xl font-bold uppercase">{menuTitle}</h1>
                        <p className="mb-5 text-2xl">{menuInfo}
                        </p>
                    </div>
                </div>
            </div>
        </Parallax>

    );
};

export default Cover;