import React from 'react';

import Header from '../template/header/header';
import Menu from '../template/menu/menu';
import Footer from '../template/footer/footer';

export const App: React.FC = ({ children }) =>
    <div className="wrapper">
        <Header/>
        <Menu/>
        <main className="content-wrapper">
            {children}
        </main>
        <Footer/>
    </div>;