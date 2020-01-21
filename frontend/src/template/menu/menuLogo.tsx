import React from 'react';

import Logo from '../../assets/logo.png';

export const MenuLogo: React.FC = () =>
    <a className="brand-link" href="#/home" >
        <img src={Logo} alt="logo" className="brand-image img-circle elevation-3"/>
        <span className="brand-text font-weight-light">Financial Control</span>
    </a>;