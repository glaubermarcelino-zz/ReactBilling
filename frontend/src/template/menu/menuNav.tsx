import React from 'react';

export const MenuNav: React.FC = ({ children }) =>
    <nav className="mt-2">
        <ul className="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
            {children}
        </ul>
    </nav>;

