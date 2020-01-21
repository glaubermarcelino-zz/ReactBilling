import React, { useState, useEffect } from 'react';

import { MenuLogo } from './menuLogo';
import { MenuUser } from './menuUser';
import { MenuItem } from "./menuItem";
import { MenuNav } from "./menuNav";

import { Constants } from "../../constants";
import { LocalStorage } from "../../factory/localStorage";

const Menu: React.FC = () => {
    const [ user, setUser ] = useState({});
    useEffect(() => {
        setUser(LocalStorage.getObject(Constants.STORAGE_USER));
    }, []);
    return(
        <aside className="main-sidebar sidebar-dark-primary elevation-4">
            <div className="logo">
                <MenuLogo/>
            </div>

            <div className="sidebar">
                <MenuUser user={user}/>
                <MenuNav>
                    <MenuItem path="/home" icon="home" label="Home"/>
                    <MenuItem path="/account" icon="wallet" label="Conta"/>
                    <MenuItem path="/transaction" icon="exchange-alt" label="Transação"/>
                </MenuNav>
            </div>
        </aside>
    );
};

export default Menu;